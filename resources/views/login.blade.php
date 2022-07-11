@extends('layouts/page')

@section('title', 'login')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <form id="form_login">
            <div class="form_fields">
                <label for="email">Email</label><input type="email" name="email" required="true">
                <label for="password">Password</label><input type="password" name="password" required="true">
            </div>
            <div id="form_response">

            </div>
            <div id="logreg_other">
                don't have an account? Register <a href="/register">here</a>
            </div>
            <div class="form_buttons">
                <input class="btn btn-primary btn-xl text-uppercase" type="button" name="login" value="login">
            </div>
        </form>
    </div>

@endsection
