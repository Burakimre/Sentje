@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="{{ url()->previous() }}">{{ __('link.back') }}</a>
                    </div>

                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ decrypt($account->name) }}: Payment Request: {{ $paymentrequest->title }}
                        </div>
                        <div class="card-body">
                            <h2>{{ $paymentrequest->title }}</h2>
                            <h6>Date Filed: {{ \Carbon\Carbon::parse($paymentrequest->created_at)->format('d/m/Y') }}</h6>
                            <h6>Due Date: {{ \Carbon\Carbon::parse($paymentrequest->date_due)->format('d/m/Y') }}</h6>
                            <p>link: <span class="boxed-in">{{ $paymentrequest->payment_url }}</span></p>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @if (empty($paymentrequest->to_user->name))
                                                Guest
                                            @else
                                                {{ decrypt($paymentrequest->to_user->name) }}
                                            @endif
                                        </td>
                                        <td>{{ $paymentrequest->requested_amount }} {{ $paymentrequest->currency->currency }}</td>
                                        <td>{{ $paymentrequest->status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="boxed-in">
                            	{{ $paymentrequest->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
