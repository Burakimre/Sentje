<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Account;
use App\PaymentRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        setLocale(LC_TIME, app()->getLocale());
    }

    public function index()
    {
        if (Auth::check()) {
            $accounts = Account::all()->where('user_id', Auth::user()->id);

            return view('accounts.index', compact('accounts'));
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('accounts.create');
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Account $account)
    {
        if (Auth::check()) {

            $ibans = Account::all()->pluck('iban');

            foreach($ibans as $iban) {
                if(decrypt($iban) == str_replace(' ', '', request('iban'))) {
                    return back()->withInput()->withErrors(array('iban' => 'There already is an account with this IBAN'));
                }
            }

            $this->validate(request(), [
                'name' => ['required', 'max:40'],
                'iban' => ['required', 'max:40', 'iban', 'unique:accounts,iban']
            ]);

            Account::create([
                'name' => encrypt(request('name')),
                'iban' => encrypt(str_replace(' ', '', request('iban'))),
                'user_id' => Auth::id()
            ]);

            

            return redirect('/accounts');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $account = Account::all()->where('id', $id)->first();
            $paymentrequests = PaymentRequest::all()->where(
                'created_by_user_id',
                Auth::user()->id
            )->where('deposit_account_id', $id);

            if ($account->user_id == Auth::user()->id) {
                return view('accounts.show', compact('account', 'paymentrequests'));
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        if (Auth::check()) {
            if ($account->user_id == Auth::user()->id) {
                return view('accounts.edit', compact('account'));
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Account $account)
    {
        if (Auth::check()) {
            if ($account->user_id == Auth::user()->id) {

                $ibans = Account::all()->pluck('iban');

                for($x = 0; $x < count($ibans); $x++) {
                    if(decrypt($ibans[$x]) == decrypt($account->iban)) {
                        unset($ibans[$x]);
                    }
                }

                foreach($ibans as $iban) {
                    if(decrypt($iban) == str_replace(' ', '', request('iban'))) {
                        return back()->withInput()->withErrors(array('iban' => 'There already is an account with this IBAN'));
                    }
                }

                $this->validate(request(), [
                    'name' => ['required', 'max:40'],
                    'iban' => ['required', 'max:40', 'iban', 'unique:accounts,iban,' . $account->id]
                ]);

                $account->update([
                    'name' => encrypt(request('name')),
                    'iban' => encrypt(str_replace(' ', '', request('iban')))
                ]);
            }

            return redirect('/accounts');
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Account $account)
    {
        if (Auth::check()) {
            if ($account->user_id == Auth::user()->id) {
                $paymentrequests = PaymentRequest::all()->where(
                    'created_by_user_id',
                    Auth::user()->id
                )->where('deposit_account_id', $account->id);

                return view('accounts.delete', compact(['account', 'paymentrequests']));
            } else {
                return redirect('/accounts');
            }
        } else {
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = false;
        $paymentrequests = PaymentRequest::all()->where('deposit_account_id', $id);

        foreach($paymentrequests as $paymentrequest) {
            if($paymentrequest->status == 'open' || $paymentrequest->status == 'pending' || $paymentrequest->status == 'partial') {
                $status = true;
            }
        }

        if (Auth::check()) {
            $account = Account::where('user_id', Auth::user()->id)->where('id', $id)->get();

            if (!$account->isEmpty() && $account[0]->id == $id) {
                if($status == false) {
                    Account::destroy($id);
                } else {
                    return back()->withErrors('');
                }
            }
            
            return redirect('/accounts/'.$account[0]->id.'/delete');
        }

        return redirect('/login');
    }
}
