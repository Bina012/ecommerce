<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{route('frontend.index')}}"><img src="{{asset('assets/frontend/img/logo.png')}}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="{{route('frontend.index')}}">Home</a></li>
                        @foreach($category as $cat)
                        <li class="nav-item submenu dropdown">
                            <a href="{{route('frontend.category',$cat->slug)}}" class="nav-link dropdown-toggle"  role="button" aria-haspopup="true"
                               aria-expanded="false">{{$cat->name}}</a>
                            <ul class="dropdown-menu">
                                @foreach($cat->subcategories as $sc)
                                    <li class="nav-item"><a class="nav-link" href="{{route('frontend.subcategory',$sc->slug)}}">{{$sc->name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(isset(Auth::guard('customer')->user()->id))
                            <li class="nav-item"><a href="{{ url('/logout') }}" class="cart">Logout</a></li>
{{--                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
{{--                                Logout--}}
{{--                            </a>--}}

{{--                            <form id="logout-form" action="{{ route('logouts') }}" method="POST" style="display: none;">--}}
{{--                                @csrf--}}
{{--                            </form>--}}

                        @else
                            <li class="nav-item"><a href="{{route('customer.login')}}" class="cart"><span class="ti-user"></span></a></li>

                        @endif
                        <li class="nav-item"><a href="{{route('cart.index')}}" class="cart"><span class="ti-bag"></span></a></li>
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
