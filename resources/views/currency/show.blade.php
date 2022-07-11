@extends('layouts/page')

@section('title', 'currency')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div id="content">
            <h3>{{$currency->currency}}</h3>
            <p>{{$currency->created_at}}</p>
            <p>{{$currency->updated_at}}</p>
        </div>
    </div>
@endsection