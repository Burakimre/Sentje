@extends('layouts/page')

@section('create', 'Home')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 35px;">
                    <div class="card-header">
                        <a href="/home">Dashboard</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Payment Request
                    </div>
                    <div class="card-body">
                        <div>{{ decrypt($paymentRequest->created_by_user->name) }}</div> {{ \Carbon\Carbon::parse($paymentRequest->created_at) }}
                        <h2>{{ $paymentRequest->currency->symbol }} {{ $paymentRequest->requested_amount }} {{ $paymentRequest->currency_id }}</h2>
                        <h2>status: {{ $paymentRequest->status }}</h2>
                        <div>
                            {{ $paymentRequest->description }}
                        </div>


                        @if( $paymentRequest->status == 'paid' )
                            Thanks for your payment
                            <div>
                                <img src="/img/paymentrequest_media/{{ $paymentRequest->media }}">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
