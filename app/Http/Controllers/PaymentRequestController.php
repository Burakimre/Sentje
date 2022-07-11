<?php

namespace App\Http\Controllers;

use App\PaymentRequest;
use Illuminate\Http\Request;
use App\Account;
use App\Currency;
use App\User;
use Auth;
use Calendar;
use Mollie\Laravel\Facades\Mollie;

class PaymentRequestController extends Controller
{
    public function __construct()
    {
        setLocale(LC_TIME, app()->getLocale());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($account_id)
    {
        if (Auth::check()) {
            $events = [];
            $data = PaymentRequest::all()->where('created_by_user_id', Auth::id());
            if($data->count()) {
                foreach ($data as $key => $value) {
                    //dd($value);
                    $events[] = Calendar::event(
                        'User: '. (!is_null($value->to_user_id) ? decrypt($value->to_user->name) : 'Guest') . '
                        Amount: ' . $value->requested_amount,
                        true,
                        new \DateTime($value->date_due),
                        new \DateTime($value->date_due),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#fed136',
                            'url' => '/accounts/'.$value->deposit_account_id.'/paymentrequests/'.$value->id,
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events);

            $account = Account::all()->where('id', $account_id)->where('user_id', Auth::user()->id)->first();
            $paymentrequests = PaymentRequest::all()->where(
                'created_by_user_id',
                Auth::user()->id
            )->where('deposit_account_id', $account_id);

            if(!is_null($account)) {
                if ($account->user_id == Auth::user()->id) {
                    return view('paymentrequests.index', compact('account', 'paymentrequests', 'calendar'));
                } else {
                    return redirect('/accounts');
                }
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentRequest $paymentRequest
     * @return \Illuminate\Http\Response
     */
    public function show($account_id, $paymentRequest)
    {
        if (Auth::check()) {
            $account = Account::all()->where('id', $account_id)->where('user_id', Auth::user()->id)->first();
            $paymentrequest = PaymentRequest::where('id', $paymentRequest)->first();

            if(!is_null($account)) {
                if ($account->user_id == Auth::user()->id) {
                    return view('paymentrequests.show', compact('account','paymentrequest'));
                } else {
                    return redirect('/accounts');
                }
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($account_id)
    {
        if (Auth::check()) {
            $contact = null;
            $currencies = Currency::all();
            $account = Account::all()->where('id', $account_id)->where('user_id', Auth::user()->id)->first();
            $users = User::all()->where('id', '!=', Auth::user()->id);

            if (isset($_POST['contact_id'])) {
                $contact = $_POST['contact_id'];
            }
            return view('paymentrequests.create', compact('account', 'currencies', 'contact', 'users'));
        } else {
            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $account_id)
    {
        $this->validate(request(), [
            'account_id' => 'required|integer',
            'to_users_id' => 'nullable|regex:(^([0-9]+,?\s*)+$)',
            'currencies_id' => 'required',
            'requested_amount' => 'required|numeric|gt:0|regex:(^\d{0,10}(\.\d{1,2})$)',
            'title' => 'required|min:1|max:30|string',
            'description' => 'required|min:4',
            'request_type' => ['required', 'regex:(payment|donation)'],
            'media' => ['image'],
            'date_due' => 'date|after_or_equal:now -1 day' 
        ]);

        //Image
        $name = 'default.gif';
        if ($request->hasFile('media')) {
            $image = $request->file('media');
            $name = request('account_id') . '_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/img/paymentrequest_media');
            $image->move($destinationPath, $name);
        }

        $amount = request('requested_amount');

        if (strlen(request('to_users_id')) > 0) {
            $to_users_id = explode(',', request('to_users_id'));
            //$amount = round($amount / sizeof($to_users_id), 2, PHP_ROUND_HALF_UP);

            foreach ($to_users_id as $to_user_id) {
                $succesUrl = 'a' . request('account_id') . 'u' . $to_user_id . 't' . time();

                $mollinfo = $this->preparePayment($amount, $succesUrl);

                PaymentRequest::create([
                    'created_by_user_id' => Auth::user()->id,
                    'to_user_id' => $to_user_id,
                    'deposit_account_id' => request('account_id'),
                    'currencies_id' => request('currencies_id'),
                    'requested_amount' => $amount,
                    'description' => request('description'),
                    'request_type' => strtolower(request('request_type')),
                    'payment_url' => $mollinfo[1],
                    'success_url' => $succesUrl,
                    'mollie_id' => $mollinfo[0],
                    'media' => $name,
                    'title' => request('title'),
                    'date_due' => request('date_due'),
                ]);
            }

            return redirect()->route('accounts.show', [$account_id]);
        } else {
            $succesUrl = 'a' . request('account_id') . 'u' . 't' . time();

            $mollinfo = $this->preparePayment($amount, $succesUrl);

            PaymentRequest::create([
                'created_by_user_id' => Auth::user()->id,
                'deposit_account_id' => request('account_id'),
                'currencies_id' => request('currencies_id'),
                'requested_amount' => $amount,
                'description' => request('description'),
                'request_type' => strtolower(request('request_type')),
                'payment_url' => $mollinfo[1],
                'success_url' => $succesUrl,
                'mollie_id' => $mollinfo[0],
                'media' => $name,
                'title' => request('title'),
                'date_due' => request('date_due'),
            ]);
        }
        return redirect('/home');
    }

    public function preparePayment($amount, $succesUrl)
    {
        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => Currency::where('id', request('currencies_id'))->first()->value('currency'),
                'value' => strval(number_format($amount, 2)),
                // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            'description' => request('description'),
            'redirectUrl' => route('success2', $succesUrl),
            'method' => ['paypal', 'banktransfer', 'ideal'],
        ]);

        $payment = Mollie::api()->payments()->get($payment->id);

        return array($payment->id, $payment->getCheckoutUrl());
    }

    public function delete($account_id, $paymentRequest)
    {
        if (Auth::check()) {
            $paymentrequest = PaymentRequest::all()->where('id', $paymentRequest)->first();

            if ($paymentrequest->created_by_user_id == Auth::user()->id) {
                return view('paymentrequests.delete', compact('paymentrequest'));
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.asdf
     *
     * @param  \App\PaymentRequest $paymentRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id, $paymentRequest)
    {
        $paymentRequest = PaymentRequest::all()->where('id', $paymentRequest)->first();

        if (Auth::check()) {
            if ($paymentRequest->created_by_user_id == Auth::user()->id) {
                $paymentRequest->status = 'canceled';
                $paymentRequest->save();

                //Mollie::api()->payments()->delete($paymentRequest->mollie_id);
            }

            return redirect('/accounts');
        }
    }

    public function success($succesurl)
    {
        $paymentRequest = PaymentRequest::where('success_url', $succesurl)->first();

        $payment = Mollie::api()->payments()->get($paymentRequest->mollie_id);

        $paymentRequest->status = $payment->status;
        $paymentRequest->save();

        //dd($payment);

        if ($paymentRequest !== null) {
            return view('paymentrequests.success', compact('paymentRequest'));
        } else {
            redirect('/');
        }
    }
}
