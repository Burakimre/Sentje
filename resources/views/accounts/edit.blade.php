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
                            {{ __('header.editaccount') }}
                        </div>

                        <div class="card-body">
                            <form id="form" action="/accounts/{{ $account->id }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="name">{{ __('header.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                           value="{{ decrypt($account->name) }}">
                                    {!! $errors->first('name', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="iban">{{ __('header.ibannumber') }}</label>
                                    <input type="text" class="form-control" id="iban" name="iban"
                                           placeholder="NL00 1234 5678 90" value="{{ decrypt($account->iban) }}">
                                    {!! $errors->first('iban', '<div class="alert alert-danger" style="margin-top: 10px;">:message</div>') !!}
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('header.editaccount') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
