@extends('layouts/page')

@section('title', 'Home')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <form id="form_register">
            <div class="form_fields">
                <label for="username">Username</label><input type="text" name="username" required="true">
                <label for="email">Email</label><input type="email" name="email" required="true">
                <label for="password">Password</label><input type="password" name="password" required="true">
                <label for="password2">Password</label><input type="password" name="password2" required="true">
            </div>
            <div id="logreg_other">
                Already have an account? Login <a href="/login">here</a>
            </div>
            <div class="form_buttons">
                <input class="btn btn-primary btn-xl text-uppercase" type="button" name="login" value="register">
            </div>
        </form>
    </div>
@endsection
