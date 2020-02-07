<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>


        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="h-100" style="background-image: url('{{Storage::url('background.png')}}')">
        <div id="app" class="h-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light position-sticky fixed-top shadow">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item @if(isset($currentPage) and $currentPage === "home") active @endif">
                                <a class="nav-link" href="{{route('home')}}">{{ucfirst(__('home'))}}</a>
                            </li>
                            <li class="nav-item @if(isset($currentPage) and $currentPage === "movies") active @endif">
                                <a class="nav-link" href="{{route('movies')}}">{{ucfirst(__('movies'))}}</a>
                            </li>
                            <li class="nav-item @if(isset($currentPage) and $currentPage === "series") active @endif">
                                <a class="nav-link" href="{{route('series')}}">{{ucfirst(__('series'))}}</a>
                            </li>
                            <li class="nav-item @if(isset($currentPage) and $currentPage === "others") active @endif">
                                <a class="nav-link" href="{{route('others')}}">{{ucfirst(__('others'))}}</a>
                            </li>
                        @endguest

                    </ul>
                    <ul class="navbar-nav ml-auto">
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
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('profile')}}">{{__('Profile')}}</a>
                                    @if (Auth::user()->admin)
                                        <a class="dropdown-item"
                                           href="{{route('admin.content')}}">{{__('Dashboard')}}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <!-- Site footer -->
{{--        <footer class="site-footer">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-8 col-sm-6 col-xs-12">--}}
{{--                        <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved by--}}
{{--                            <a href="#">WeTuga</a>.--}}
{{--                        </p>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-4 col-sm-6 col-xs-12">--}}
{{--                        <ul class="social-icons">--}}
{{--                            <li><a class="facebook" href="#facebook"><i class="fa fa-facebook-square"></i></a></li>--}}
{{--                            <li><a class="twitter" href="#twitter"><i class="fa fa-twitter-square"></i></a></li>--}}
{{--                            <li><a class="linkedin" href="#linkedin"><i class="fa fa-linkedin-square"></i></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </footer>--}}
    </body>
    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
</html>
