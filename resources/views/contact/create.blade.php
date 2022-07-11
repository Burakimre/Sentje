@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="/contact">{{ __('link.contact') }}</a>
                    </div>
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            <b>{{ __('header.addcontact')}}</b>
                        </div>

                        <div class="card-body">
                            <form id="form" action="/contact" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="contact">{{ __('header.user')}}</label>
                                    <select class="form-control" name="contact">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ decrypt($user->name) }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('contact', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('header.addcontact')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
