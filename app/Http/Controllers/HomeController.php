<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Contact;
use App\PaymentRequest;
use App\Account;
use App\Group;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $openrequests = PaymentRequest::all()->where('created_by_user_id', Auth::user()->id)->where('status', 'open');
        $friends = Contact::all()->where('user_id', Auth::user()->id);
        $paymentrequests = PaymentRequest::all()->where('to_user_id', Auth::user()->id)->where('status', 'open');
        $accounts = Account::all()->where('user_id', Auth::user()->id);
        $groups = Group::all()->where('owner_id', Auth::user()->id);

        return view('home', compact(['friends', 'paymentrequests', 'accounts', 'groups', 'openrequests']));
    }
}
