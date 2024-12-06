<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">

                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item {{ request()->is('shop') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('shop')}}">Shop</a>
                </li>
                <li class="nav-item {{ request()->is('about') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('about')}}">About Us</a>
                </li>
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('contact')}}">Contact us</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li>
                    <a class="nav-link cart" href="{{route('cart')}}"><img src="{{asset('public/assets/images/cart.svg')}}" alt="img">
                        <span id="cart-count" class="badge">0</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link cart" href="{{route('wishlist')}}"><img src="{{asset('public/assets/images/wishlist.svg')}}" alt="img"></a>
                </li>

                @if(Auth::check())
                    <li><a class="nav-link" href="{{route('user.dashboard')}}"><img src="{{asset('public/assets/images/user.svg')}}" alt="img"></a></li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button class="btn btn-secondary mx-4" type="submit">Logout</button>
                    </form>
                @else
                    <li><a class="nav-link" href="{{route('login.page')}}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
