@guest
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
                <a class="nav-link-custom js-scroll-trigger" href="{{ url('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link-custom js-scroll-trigger" href="{{ url('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link-custom js-scroll-trigger" href="{{ url('/locale/nl') }}">
                    <img src={{ url('img/nl.png') }} width="15px" height="15px">
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link-custom js-scroll-trigger" href="{{ url('/locale/en') }}">
                    <img src="{{ url('img/uk.png') }}" width="15px" height="15px">
                </a>
            </li>
        </ul>
    </div>
@else
    <div class="collapse navbar-collapse float-right" id="navbarResponsive">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" v-pre>
            {{ decrypt(Auth::user()->name) }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if(Auth::user()->role_id == 2)
                <a class="dropdown-item" href="/admin">Admin</a>
            @endif

            <a class="dropdown-item" href="{{ route('home') }}">{{ __('header.dashboard') }}</a>
            <a class="dropdown-item" href="{{ route('accounts.index') }}">{{ __('header.account') }}</a>
            <a class="dropdown-item" href="{{ route('payment.index') }}">{{ __('header.payment') }}</a>
            <a class="dropdown-item" href="{{ route('group.index') }}">{{ __('header.group') }}</a>
            <a class="dropdown-item" href="{{ route('contact.index') }}">{{ __('header.contact') }}</a>
            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">{{ __('header.setting') }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('header.logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <a class="nav-link-custom js-scroll-trigger" href="{{ url('/locale/nl') }}">
            <img src={{ url('img/nl.png') }} width="15px" height="15px">
        </a>
        <a class="nav-link-custom js-scroll-trigger" href="{{ url('/locale/en') }}">
            <img src="{{ url('img/uk.png') }}" width="15px" height="15px">
        </a>
    </div>
@endguest
