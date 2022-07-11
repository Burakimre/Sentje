@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ __('header.mypayment') }}
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <td scope="col">{{ __('header.payment') }}</td>
                                    <td scope="col" style="text-align: center;"><i class="fas fa-cog"
                                                                                   style="font-size: 20px; vertical-align: middle; color: #D8D8D8;"></i>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
