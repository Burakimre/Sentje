@extends('layouts/page')

@section('title', 'Home')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('header.edituser') }}</div>

                        <div class="card-body">
                            <form id="form" method="POST" action="/users/{{ $user->id }}">
                                @csrf
                                @method('PATCH')

                                <div class="form-group">
                                    <label for="name">{{ __('header.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ decrypt($user->name) }}"/>
                                    {!! $errors->first('name', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ $user->email }}"/>
                                    {!! $errors->first('email', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="password">{{ __('header.newpassword') }}</label>
                                    <input type="password" class="form-control" id="password" name="password"/>
                                    {!! $errors->first('password', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">{{ __('header.confirmnewpassword') }}</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                           name="password_confirmation"/>
                                    {!! $errors->first('confirmPassword', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('header.edituser') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
