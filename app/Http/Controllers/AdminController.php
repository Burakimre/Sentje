<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Group;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                return view('admin.index');
            }
        }

        return redirect('/');
    }

    public function groups()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                $groups = Group::All();
                return view('admin.groups', ['groups' => $groups]);
            }
        }

        return redirect('/');
    }

    public function users()
    {
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                $users = User::All();
                return view('admin.users', ['users' => $users]);
            }
        }

        return redirect('/');
    }

    private function welcome()
    {
        redirect('/');
    }
}
