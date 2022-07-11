@extends('layouts/page')

@section('title', 'admin')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div id="content">
            <div>
                <ul>
                    @foreach($users as $user)
                        <li>
                            <a href="/admin/users/{{$user->id}}">{{$user->name}}</a>
                            @if($user->role_id == 2)
                                <span> admin</span>
                            @else
                                <span> user</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection