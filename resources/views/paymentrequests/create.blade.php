@extends('layouts/page')

@section('create', 'Home')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="/accounts/{{$account->id}}">{{ __('link.back') }}</a>
                    </div>

                    <div class="card">
                    	<div class="card-header">
	                        {{ __('header.addpaymentrequest') }}
	                    </div>
                        <div class="card-body">
                            <form method="POST" action="/accounts/{{$account->id}}/paymentrequests" id="form"
                                  enctype="multipart/form-data">
                                {{csrf_field() }}
                                <input type="hidden" name="account_id" required value="{{$account->id}}">

                                <div class="form-group">
                                    <div id="select_user" class="row">
                                        <input type="hidden" name="to_users_id" value="">
                                        <div id="all_users" class="col-5">
                                            @foreach($users as $user)
                                                <div class="user"><span>{{ $user->id }}</span>{{ decrypt($user->name) }}</div>
                                            @endforeach
                                        </div>
                                        <div id="buttons" class="col-sm">
                                            <input type="button" class="btn btn-primary btn-sm" style="width: 40px;"
                                                   name="allin" value=">>">
                                            <input type="button" class="btn btn-primary btn-sm" style="width: 40px;"
                                                   name="in" value=">">
                                            <input type="button" class="btn btn-primary btn-sm" style="width: 40px;"
                                                   name="out" value="<">
                                            <input type="button" class="btn btn-primary btn-sm" style="width: 40px;"
                                                   name="allout" value="<<">
                                        </div>
                                        <div id="paymentrequest_reciever" class="col-5">

                                        </div>
                                    </div>
                                    @if( $errors->has('to_user_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('to_user_id') }}

                                        </div>
                                    @endif
                                </div>
                                 <div class="form-group">
                                    <label for="title">{{ __('header.title') }}</label>
                                    <input type="text" class="form-control" name="title" min="1" max="30" required>
                                    @if( $errors->has('title'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('title') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="date_due">{{ __('header.date_due') }}</label>
                                    <input type="date" class="form-control" name="date_due">
                                    @if( $errors->has('date_due'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('date_due') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="currencies_id">{{ __('header.currency') }}</label>
                                    <select class="form-control" name="currencies_id">
                                        <option selected value="">{{ __('header.selectcurrency') }}</option>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}">{{ $currency->currency }}</option>
                                        @endforeach
                                    </select>
                                    @if( $errors->has('currencies_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('currencies_id') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="requested_amount">{{ __('header.amount') }}</label>
                                    <input class="form-control" type="number" name="requested_amount"
                                           pattern="^\d{1,3}(.\d{3})*(\.\d+)?$" value="{{ old('requested_amount') }}"
                                           data-type="currency" placeholder="€1.00" required min="1" step="any">
                                    @if( $errors->has('requested_amount'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('requested_amount') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="request_type">{{ __('header.requesttype') }}</label>

                                    <select class="form-control" name="request_type">
                                        <option value="payment">{{ __('header.payment') }}</option>
                                        <option value="donation">{{ __('header.donation') }}</option>
                                    </select>
                                    @if( $errors->has('request_type'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('request_type') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ __('header.description') }}</label>
                                    <textarea class="form-control" name="description"
                                              required>{{ old('description') }}</textarea>
                                    @if( $errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}

                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div id="form_media">
                                        <label for="request_type">{{ __('header.selectmedia') }}</label>
                                        <input type="file" name="media">
                                        <div id="media"><img src="/img/placeholder.png" alt="media"></div>
                                    </div>
                                    @if( $errors->has('media'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('media') }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <input type="submit" name="btn_submit" value="{{ __('header.addpaymentrequest') }}"><a
                                            href="/accounts/{{$account->id}}">cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
