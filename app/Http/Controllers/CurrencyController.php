<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $currencies = Currency::All();
                return view('currency.index', ['currencies' => $currencies]);
            }
        }

        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                return view('currency.create');
            }
        }

        return redirect('/login');
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
            if (Auth::user()->role == 0) {
                $currency = Currency::find($id);
                return view('currency.create', ['currencies' => $currency]);
            }
        }

        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if (Auth::check()) {
            $values = request()->validate([
                'currency' => ['required', 'min:2', 'string', 'max:45']
            ]);

            Currency::create($values);

            return redirect('/currency');
        }

        return redirect('/login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role == 0) {
            $currency = Currency::find($id);
            //dd($currency);
            return view('currency.update', ['currency' => $currency]);
        }
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
        //
    }
}
