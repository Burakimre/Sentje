<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function show(){
        return view('welcome');
    }

    public function edit(User $user)
    {
        if(Auth::check()) {
            $user = Auth::user();
            return view('users.edit', compact('user'));
        }

        return view('auth/login');
    }

    public function update(User $user)
    {
        if($user->id == Auth::id()) {
            $this->validate(request(), [
                'name' => 'required|max:45',
                'email' => 'required|max:100|email|unique:users,email,' . $user->id,
                'password' => 'required|min:6|max:191|confirmed',
            ]);
    
            $user->name = encrypt(request('name'));
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
    
            $user->save();
    
            return back();
        }

        return view('welcome');
    }
}
