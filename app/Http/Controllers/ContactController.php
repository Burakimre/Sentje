<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Contact;
use App\User;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $contacts = Contact::all()->where('user_id', Auth::user()->id);

            return view('contact.index', compact('contacts'));
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
            $users = User::all()->where('id', '!=', Auth::user()->id);

            return view('contact.create', compact('users'));
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $this->validate(request(), [
                'contact' => 'required|unique:contacts,user_id1,NULL,id,user_id,' . Auth::id()
            ]);


            Contact::create([
                'user_id' => Auth::user()->id,
                'user_id1' => request('contact')
            ]);

            return redirect('/contact');
        } else {
            authFail();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $contact = Contact::where('id', $id)->where('user_id', Auth::id())->first();

            if(!is_null($contact)) {
                Contact::destroy($id);
            }

            return redirect('/contact');
        }

        return redirect('/login');
    }
}
