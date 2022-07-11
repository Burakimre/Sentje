@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ decrypt($paymentrequest->account->name) }}: Payment Requests: {{ $paymentrequest->description }}
                        </div>
                        <div class="card-body">

                            <form class=""
                                  action="/accounts/{{ $paymentrequest->deposit_account_id }}/paymentrequests/{{ $paymentrequest->id }}"
                                  method="post">
                                @csrf
                                @method('DELETE')

                                @if($paymentrequest->status == 'open')
                                    <button type="submit" class="btn btn-primary" style="background-color: red;">Cancel
                                        Request
                                    </button>
                                @endif
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection