<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('home') }}"><img src="{{ asset('front/img/logo.png') }}"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="ml-auto nav navbar-nav menu_nav">
                        <li @class(['nav-item', 'active' => request()->routeIs('home')])><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li @class(['nav-item', 'active' => request()->routeIs('shop')])><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                        @auth
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-danger" value="Logout">
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-sm btn-success" href="{{ route('login') }}">Login</a>
                            </li>
                        @endguest
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @auth
                            <li class="nav-item"><a href="{{ route('cart.index') }}" class="cart"><span
                                        class="ti-bag"></span></a></li>
                        @endauth
                        @guest
                            <li class="nav-item"><a href="{{ route('login') }}" class="cart"><span
                                        class="ti-bag"></span></a></li>
                        @endguest
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
