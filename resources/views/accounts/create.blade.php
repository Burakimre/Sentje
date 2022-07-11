@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="/accounts">{{ __('link.accounts') }}</a>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            {{ __('header.addaccount') }}
                        </div>

                        <div class="card-body">
                            <form id="form" action="/accounts" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('header.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                    {!! $errors->first('name', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="iban">{{ __('header.ibannumber') }}</label>
                                    <input type="text" class="form-control" id="iban" name="iban"
                                           placeholder="NL00 1234 5678 90" value="{{ old('iban') }}">
                                    {!! $errors->first('iban','<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('header.addaccount') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
