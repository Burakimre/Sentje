@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="backlink">
                    	<i class="fas fa-arrow-left"></i> <a href="/home">{{ __('link.dash') }}</a>
                    </div>
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ __('header.mycontact') }}
                            <a href="/contact/create">
                                <i class="fas fa-plus-square"
                                   style="font-size: 30px; vertical-align: middle; float:right;"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <td scope="col">{{ __('header.contactname') }}</td>
                                    <td scope="col" style="text-align: center;"><i class="fas fa-cog"
                                                                                   style="font-size: 20px; vertical-align: middle; color: #D8D8D8;"></i>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td>
                                            {{ decrypt($contact->user1->name) }}
                                        </td>
                                        <td class="text-center">
                                            <div class="row justify-content-center">
                                                <div>
                                                    <form id="formDelete" method="post"
                                                          action="/contact/{{ $contact->id }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <a onclick="document.getElementById('formDelete').submit();"><i
                                                                    class="fas fa-trash-alt"
                                                                    style="font-size:20px; color:red; cursor: pointer;"></i></a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
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
