@extends('layouts/page')

@section('title', 'admin')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div id="content">
            <div>
                <a href="/currency">currencies</a>
            </div>
            <br>
            <div>
                <a href="/admin/users">users</a>
            </div>
            <br>
            <div>
                <a href="/admin/groups">groups</a>
            </div>
            <br>
        </div>
    </div>
@endsection