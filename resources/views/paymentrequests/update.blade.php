@extends('layouts/page')

@section('update', 'Home')

@section('content')
    <div id="bg_img">

        <form method="POST" action="/paymentrequest/create" id="form">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <label for="user">User</label>
            <select name="user">
                @foreach($users as $user)
                    <option value="{{ $user->ID }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <label for="account">Account</label>
            <select name="account">
                @foreach($accounts as $account)
                    <option value="{{ $account->ID }}">{{ $account->name }}</option>
                @endforeach
            </select>
            <label for="currency">Currency</label>
            <select name="currency">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->ID }}">{{ $currency->name }}</option>
                @endforeach
            </select>

            <label for="amount">Amount</label>
            <input type="number" name="amount" required>

            <label for="description">Description</label>
            <textarea name="description" required=""></textarea>
            <label for="request_type">Request type</label>

            <select name="request_type">
                <option value="payment">Payment</option>
                <option value="donation">Donation</option>
            </select>

            <div>
                <input type="submit" name="btn_submit" value="create"><a href="/"></a>
            </div>
        </form>

    </div>
@endsection