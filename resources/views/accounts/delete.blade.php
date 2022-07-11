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
                            Delete account: {{ decrypt($account->name) }} - {{ decrypt($account->iban) }}
                        </div>

                        <div class="card-body">
                            @if (!$paymentrequests->isEmpty())
                                <strong style="color:red;">You have open payment requests to this account. You can't delete this account, but here's this message anyways just to bother you!</strong>
                                <table class="table table-hover" style="margin: 40px 0px;">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Pending amount</th>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($paymentrequests as $paymentrequest)
                                        <tr>
                                            <td>{{ $paymentrequest->to_user_id }}</td>
                                            <td>{{ decrypt($paymentrequest->to_user->name) }}</td>
                                            <td>{{ $paymentrequest->requested_amount }}</td>
                                            <td>{{ $paymentrequest->currency->currency }}</td>
                                            <td>{{ $paymentrequest->status }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <strong style="color:green; margin-bottom:40px;">You have no open payment requests to
                                    this account. Are you sure you want to delete this account?</strong>
                            @endif
                            <form class="" action="/accounts/{{ $account->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary" style="background-color: red;">Delete
                                    account
                                </button>
                            </form>
                            @if($errors->any())
                                </br>
                                <div class="alert alert-danger" role="alert">
                                    {{ __('header.accountdeletionerror') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
