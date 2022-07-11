@extends('layouts/page')

@section('create', 'account')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('header.showgroup') }} {{ $groups->groupname }}
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label>
                                        <b>{{ __('header.groupname') }}</b>: {{ $groups->groupname }}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <ul class="list-group"
                                        style="max-height: 300px; overflow: scroll; overflow-x: hidden;">
                                        @foreach ($groupusers as $groupuser)
                                            <li class="list-group-item">
                                                <strong>
                                                    {{ decrypt($groupuser->user->name) }}
                                                </strong>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
