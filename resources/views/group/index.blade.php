@extends('layouts/page')

@section('title', 'Home')

@section('content')
    <div id="bg_img" style="background-image: url(/../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 50px;">
                        <div class="card-header">
                            {{ __('header.mygroup') }}
                            <a href="/group/create">
                                <i class="fas fa-plus-square"
                                   style="font-size: 30px; vertical-align: middle; float:right;"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('header.groupname') }}</th>
                                    <th></th>
                                    <th scope="col" style="text-align: center;"><i class="fas fa-cog"
                                                                                   style="font-size: 20px; vertical-align: middle; color: #D8D8D8;"></i>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <td><a href="/group/{{ $group->id }}">{{ $group->groupname }}</a></td>
                                        <td></td>
                                        <td class="text-center">
                                            <div class="row justify-content-center">
                                                <div>
                                                    <form id="formDelete" method="post"
                                                          action="/group/{{ $group->id }}">
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
