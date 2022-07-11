@extends('layouts/page')

@section('title', 'currency - overview')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div id="content">
            <div>
                <a href="/currency/create">new</a>
            </div>
            <br>
            <div>
                <h3>Currencies</h3>
                @if($currencies->count())
                    <ul>
                        @foreach($currencies as $currency)
                            <li>
                                <span><a href="/currency/{{$currency->id}}">{{$currency->currency}}</a></span><a
                                        href="/currency/{{$currency->id}}/edit">update</a><a
                                        href="/currency/{{$currency->id}}/delete">delete</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>geen currencies dus dan maar met eieren betalen</p>
                @endif
            </div>
        </div>
    </div>
@endsection
