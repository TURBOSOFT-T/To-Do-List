<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">


    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
     <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @yield('style')

    <!-- script
    ================================================== -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script defer src="{{ asset('js/fontawesome/all.min.js') }}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

</head>

<body id="top">


    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader"></div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header @unless(currentRoute('home')) s-header--opaque @endunless">

        <div class="s-header__logo">
            <a class="logo" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.svg') }}"  width="100"  height="100" alt="Homepage">
            </a>
        </div>

        <div class="row s-header__navigation">

            <nav class="s-header__nav-wrap">

                <h3 class="s-header__nav-heading h6">@lang('Navigate to')</h3>

                <ul class="s-header__nav">
                    <li {{ currentRoute('home') }}>
                        <a href="{{ route('home') }}" title="">@lang('Home')</a>
                    </li>

                    @if(auth()->user())
                    <li>
                        <a href="{{ url('admin') }}" class="nav-item nav-link">@lang('Administration')</a>
                    </li>



                    @endif
                    <li class="has-children">


                        <!-- Authentication Links -->
                        @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Deconnexion
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest

                    </li>
                </ul>

                <a href="#0" title="@lang('Close Menu')"
                    class="s-header__overlay-close close-mobile-menu">@lang('Close')</a>

            </nav>

        </div>

        <a class="s-header__toggle-menu" href="#0" title="@lang('Menu')"><span>@lang('Menu')</span></a>

        <div class="s-header__search">

            <div class="s-header__search-inner">
                <div class="row wide">

                    <form role="search" method="get" class="s-header__search-form" action="{{ Route('menus.search') }}">
                        <label>
                            <span class="h-screen-reader-text">@lang('Search for:')</span>
                            <input id="search" type="search" name="search" class="s-header__search-field"
                                placeholder="@lang('Search for...')" title="@lang('Search for:')" autocomplete="off">
                        </label>
                        <input type="submit" class="s-header__search-submit" value="Search">
                    </form>

                    <a href="#0" title="@lang('Close Search')" class="s-header__overlay-close">@lang('Close')</a>

                </div>
            </div>

        </div>

        <a class="s-header__search-trigger" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.982 17.983">
                <path fill="#010101"
                    d="M12.622 13.611l-.209.163A7.607 7.607 0 017.7 15.399C3.454 15.399 0 11.945 0 7.7 0 3.454 3.454 0 7.7 0c4.245 0 7.699 3.454 7.699 7.7a7.613 7.613 0 01-1.626 4.714l-.163.209 4.372 4.371-.989.989-4.371-4.372zM7.7 1.399a6.307 6.307 0 00-6.3 6.3A6.307 6.307 0 007.7 14c3.473 0 6.3-2.827 6.3-6.3a6.308 6.308 0 00-6.3-6.301z" />
            </svg>
        </a>

    </header>


    <!-- hero
    ================================================== -->
    @yield('hero')


    <!-- content
    ================================================== -->
    <section class="s-content @if(currentRoute('home')) s-content--no-top-padding @endif">

        @yield('main')

    </section>


    <!-- footer
    ================================================== -->
 

    <!-- JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')

</body>

</html>
