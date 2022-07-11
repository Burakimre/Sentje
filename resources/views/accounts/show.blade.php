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
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ decrypt($account->name) }}
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('header.accountname') }}</th>
                                    <th scope="col">{{ __('header.ibannumber') }}</th>
                                    <th scope="col" style="text-align: center;"><i class="fas fa-cog" style="font-size: 20px; vertical-align: middle; color: #D8D8D8;"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ decrypt($account->name) }}</td>
                                    <td>{{ decrypt($account->iban) }}</td>
                                    <td class="text-center">
                                        <a href="{{ url("/accounts/$account->id/edit") }}">
                                        	<i class="fas fa-edit" style="font-size:20px; margin-right: 10px; color:#2578AF;"></i>
                                        </a>
                                        <a href="{{ url("/accounts/$account->id/delete") }}">
                                        	<i class="fas fa-trash-alt" style="font-size:20px; color:red;"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            <a href="/accounts/{{ $account->id }}/paymentrequests">{{ __('header.myrequests') }}</a>
                            <a href="/accounts/{{ $account->id }}/paymentrequests/create">
                                <i class="fas fa-plus-square" style="font-size: 30px; vertical-align: middle; float:right;"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">{{ __('header.user') }}</th>
                                    <th scope="col">{{ __('header.amount') }}</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">{{ __('header.datefiled') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($paymentrequests as $paymentrequest)
                                    <tr>
                                    	<td><a href="/accounts/{{ $account->id }}/paymentrequests/{{ $paymentrequest->id }}"><i class="fas fa-angle-right"></i></a></td>
                                        <td>
                                            @if (empty($paymentrequest->to_user->name))
                                                Guest
                                            @else
                                                {{ decrypt($paymentrequest->to_user->name) }}
                                            @endif
                                        </td>
                                        <td>{{ $paymentrequest->requested_amount }} {{ $paymentrequest->currency->currency }}</td>
                                        <td>{{ $paymentrequest->status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($paymentrequest->created_at)->formatLocalized('%A %d %B %Y') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
