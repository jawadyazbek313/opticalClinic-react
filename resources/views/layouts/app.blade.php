<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @livewireStyles
  
    @powerGridStyles
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>.swal2-container {
        z-index: 20000 !important;
      }</style>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" defer></script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/gijgo.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/gijgo.min.css') }} " rel="stylesheet">
    <link href="{{ asset('css/bootstrap-select.css') }} " rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/adminlte.min.css') }} " rel="stylesheet"> --}}

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        body::after {
            content: "";
            background: url({{ asset('images/bg.png') }});
            opacity: 0.05;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: fixed;
            z-index: -1;
        }
    </style>

    <style>
        .nav-item:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div id="app" class="relative">
        <nav @if (app()->getLocale() == 'ar') style="direction:rtl !important" @endif
            class=" navbar
            navbar-expand-lg navbar-light bg-white shadow-sm sticky-top "
            data-nav-status="toggle">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="transition: all 0.5s ease-in-out; height: 30px !important;" class="hoverbadges"
                        src="{{ asset('images/logo (1).png') }}"   alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::user())
                        <ul class="navbar-nav @if (app()->getLocale() == 'ar') ml-auto  @else mr-auto @endif">


                            <li
                                class="nav-item dropdown {{ request()->is('patient/create') ? 'active' : '' }}{{ request()->is('patient') ? 'active' : '' }}{{ request()->is('member/create') ? 'active' : '' }}">
                                <a type="button" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('lang.MenuItemPatients') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center {{ request()->is('patient') ? 'active' : '' }}"
                                        href="{{ route('patient.index') }}">
                                        {{ __('lang.listPatient') }}
                                    </a> <a
                                        class="dropdown-item text-center {{ request()->is('patient/create') ? 'active' : '' }}"
                                        href="{{ route('patient.create') }}">
                                        {{ __('lang.addPatient') }}
                                    </a>



                                </div>


                            </li>



                            <li
                                class="nav-item dropdown {{ request()->is('appointment') ? 'active' : '' }} {{ request()->is('appointments/trashlist') ? 'active' : '' }} {{ request()->is('appointment/create') ? 'active' : '' }}">
                                <a type="button" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('lang.listAppointment') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-center {{ request()->is('appointment') ? 'active' : '' }}"
                                        href="{{ route('appointment.index') }}">
                                        {{ __('lang.listAppointment') }}
                                    </a> <a
                                        class="dropdown-item text-center {{ request()->is('appointment/create') ? 'active' : '' }}"
                                        href="{{ route('appointment.create') }}">
                                        {{ __('lang.addAppointment') }}
                                    </a>
                                    <a class="dropdown-item text-center {{ request()->is('appointments/trashlist') ? 'active' : '' }}"
                                        href="{{ route('appointment.trashlist') }}">
                                        {{ __('lang.DeletedAppointment') }}
                                    </a>



                                </div>
                            </li>
                        </ul>
                    @endif


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav @if (app()->getLocale() == 'ar') mr-auto  @else ml-auto @endif ">
                        <!-- Authentication Links -->

                        @guest
                            @if (Route::has('login'))
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('lang.register') }}</a>
                                </li>
                            @endif
                        @else
                            @role('admin')
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('lang.adminPanel') }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('permissions.index') }}">
                                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                                            </i> Permissions
                                        </a>
                                        <a class="dropdown-item" href="{{ route('roles.index') }}">
                                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                                            </i> Roles
                                        </a>
                                        <a class="dropdown-item" href="{{ route('users.index') }}">
                                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                                            </i> Users
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>


                                    </div>
                                <li class="nav-item">
                                    <a class="nav-link" href="">

                                    </a>
                                </li>


                                <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                                    {{ __('lang.admin') }}

                                </div>
                            @endrole
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right text-center"
                                    aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('lang.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>


                                </div>
                            </li>

                        @endguest
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Config::get('languages')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu text-center dropdown-menu-right"
                                aria-labelledby="navbarDropdownMenuLink">
                                @foreach (Config::get('languages') as $lang => $language)
                                    @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                            {{ __($language) }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        @auth

            @livewire('messages')
        @endauth

        <main class="py-4 ">
            @yield('content')
        </main>
    </div>
    <script>
        $.fn.selectpicker.Constructor.BootstrapVersion = '4';
    </script>

@livewireScripts
@powerGridScripts
</body>

</html>
