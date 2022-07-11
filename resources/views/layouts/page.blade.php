<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="ltr">
<head>
    @include('partials._metaData')

    <title>@yield('title') | {{ config('app.name', 'Sentje') }}</title>
    <link rel="icon" type="image/png" href="/./img/icon.png"/>

    @include('partials._styles')
    @yield('style')
</head>
<body id="page-top">
@include('partials._header')
<div id="content_wrapper">
    @yield('content')
</div>
@include('partials._footer')

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('js/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="{{ asset('js/agency.min.js') }}"></script>
<script src="{{ asset('js/userselect.js') }}"></script>
@yield('script')
</body>
</html>
