<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <img src="{{ env('AWS_S3_URL') }}common/reviewers.exchange-logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            @include('layouts.appname')
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
                @if ('publisher' == Auth::user()->type)
                    <ul class="navbar-nav mr-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('/publisher/reviewers/list') }}">{{ __('Reviewers') }}</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="/publisher/reviewer-list">{{ __('Reviewers') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/publisher/statement">{{ __('Statement of account') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/publisher/settings">{{ __('Settings') }}</a>
                        </li>
                    </ul>                
                @endif
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>                        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>                    
                @endguest
            </ul>
        </div>
    </div>
</nav>