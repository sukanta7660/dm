<div class="py-1 bg-black d-print-none">
    <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
            <div class="col-lg-12 d-block">
                <div class="row d-flex">
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                        <span class="text">{{config('sp.contact')}}</span>
                    </div>
                    <div class="col-md pr-4 d-flex topper align-items-center">
                        <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                        <span class="text">{{config('sp.email')}}</span>
                    </div>
                    <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                        <span class="text"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light d-print-none" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{action('User\IndexController@index')}}">{{config('sp.company')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{action('User\IndexController@index')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{action('User\ProductController@index')}}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{action('User\ProductController@index')}}">Doctors</a></li>
                <li class="nav-item"><a href="{{action('User\StaticPageController@about')}}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{action('User\ContactController@index')}}" class="nav-link">Contact</a></li>
                <li class="nav-item cta cta-colored"><a href="{{action('User\ProductCartController@index')}}" class="nav-link"><span class="icon-shopping_cart"></span><span id="cart_item"> </span></a></li>
                @if(isset(Auth::user()->email))
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</a>
                    <div class="dropdown-menu" aria-labelledby="profile">
                        <a class="dropdown-item" href="{{action('User\ProfileController@index',['profile' => Auth::user()->name])}}">Profile</a>
                        <a class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" href="{{route('logout')}}">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
