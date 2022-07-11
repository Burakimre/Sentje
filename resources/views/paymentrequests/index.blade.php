@extends('layouts/page')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="{{ url()->previous() }}">{{ __('link.back') }}</a>
                    </div>

                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('header.user') }}</th>
                                    <th scope="col">{{ __('header.amount') }}</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">{{ __('header.datefiled') }}</th>
                                    <th scope="col" style="text-align: center;"><i class="fas fa-cog" style="font-size: 20px; vertical-align: middle; color: #D8D8D8;"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($paymentrequests as $paymentrequest)
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
                                        <td>{{ \Carbon\Carbon::parse($paymentrequest->created_at)->formatLocalized('%A %d %B %Y') }}</td>
                                        <td class="text-center">
                                        @if($paymentrequest->status != 'paid' && $paymentrequest->status != 'expired')
                                            <a href="/accounts/{{ $paymentrequest->deposit_account_id }}/paymentrequests/{{ $paymentrequest->id }}/delete" alt="cancel">
                                                <i class="fas fa-ban" style="font-size:20px;"></i>
                                            </a>
                                        @else
                                        <a href="#" alt="cancel">
                                                <i class="fas fa-ban" style="font-size:20px;"></i>
                                            </a>
                                        @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            
                            <div class="divider"></div>
                            
                            {!! $calendar->calendar() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
@endsection