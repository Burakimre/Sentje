@extends('layouts/page')

@section('title', 'admin')

@section('content')
    <div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
        <div id="content">
            <div>
                <ul>
                    @foreach($groups as $group)
                        <li>
                            <a href="/admin/groups/{{$group->id}}">{{$group->id}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
@endsection