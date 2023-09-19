<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    
    <div id="app">
         <!-- header -->
    <header class="Cheader">
        <a class="titleLogo" > <i class="fa fa-suitcase"></i> Job </a>

        <nav class="navbar">   
        @if(Auth::check() && (Auth::user()->u_role === 'job_seeker'))
            <a href="/">Home</a>
        @elseif(Auth::check() &&Auth::user()->u_role === 'employer')
            <a href="/employerjobpost">Home</a>
            @else
            <a href="/">Home</a>
        @endif
    
            <a href="{{route('video.home')}}">Short Video</a>
            <a href="/blog">Blog</a>
        @if(Auth::check() && (Auth::user()->u_role === 'job_seeker'))
            <a href="/quizzes">Quizz</a>
        @endif
        @if(Auth::check())   
            <a href="/chatBot">AI ChatBot</a>
        @endif
            <a href="/aboutus">About Us</a>
        </nav>

        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" style="font-size:15px">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size:15px">
                        {{ __('Register') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('register') }}" style="font-size:15px">
                            {{ __('Register JobSeeker') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('register.employer') }}" style="font-size:15px">
                            {{ __('Register Employer') }}
                        </a>

                    </div>
                </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="font-size:15px">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                    @if(Auth::user()->u_role === 'job_seeker')
                        <a class="dropdown-item" href="/editProfile" style="font-size:15px">
                            {{ __('Edit Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('user.profile',Auth::user()->id) }}" style="font-size:15px">
                            {{ __('Profile') }}
                        </a>
                    @elseif(Auth::user()->u_role === 'employer')
                        <a class="dropdown-item" href="/editEmpProfile" style="font-size:15px">
                            {{ __('Edit Profile') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('profileEmp.show',Auth::user()->id) }}" style="font-size:15px">
                            {{ __('Profile') }}
                        </a>
                    @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}" style="font-size:15px"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            
                </ul>
                @if(Auth::user()->u_role === 'employer')
                <div class="icons">
                    <a href="{{'/notification'}}"><i class="fa fa-envelope"></i></a>
                </div>
                @elseif(Auth::user()->u_role === 'job_seeker')
                <div class="icons">
                    <a href="{{'/notificationJ'}}"><i class="fa fa-envelope"></i></a>
                </div>
                @endif
            @endguest
    </header>
    <!-- header end -->
    
    <main class="main-content">
        @yield('content')
    </main>
    </div>
</body>
</html>