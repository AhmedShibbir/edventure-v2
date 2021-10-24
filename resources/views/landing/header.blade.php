<nav class="navbar navbar-expand-lg navbar-light {{$headerBg == 'white' ? "position-relative bg-light " : "position-absolute"}} w-100">
    <a class="navbar-brand" href="#"><img src="/img/landing/logo.png" width="220" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item has-dot  {{Route::current()->getName() == 'home' ? 'active' : ''}}">
            <a class="nav-link text-purple-half" href="{{route('home')}}">HOME</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">EXAM</a>
            </li>

            @if (Route::has('login'))
                @auth
                    <li class="nav-item has-dot">
                    <a class="nav-link text-purple-half" href="#">DASHBOARD</a>
                </li>
                @endauth     
            @endif

            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">RESOURCES</a>
            </li>

            <li class="nav-item has-dot {{Route::current()->getName() == 'about_us' ? 'active' : ''}}">
                <a class="nav-link text-purple-half " href="{{route('about_us')}}">ABOUT US</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">CONTACT US</a>
            </li>
            <li class="nav-item has-dot">
            <a class="nav-link text-purple-half" href="#">HELP</a>
            </li>
        </ul>
        @if (Route::has('login'))
                @auth
                    <div class="nav navbar-nav flex-nowrap d-flex mr-16pt">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown"
                                data-caret="false">
                                <span class="avatar avatar-sm mr-8pt2">
                                    <span class="avatar-title rounded-circle bg-purple text-white" style="padding: 8px 10px"><i class="fas fa-user"></i></span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header"><strong>Account</strong></div>
                                <a class="dropdown-item" href="{{route('profile', auth()->user()->id)}}">My
                                    Dashboard</a>
                                <a class="dropdown-item" href="#">All courses</a>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); 
                                                                            this.closest('form').submit();">
                                        Log out
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
        <div class="my-2 my-lg-0">
            <a class="nav-item active my-2 my-sm-0 pr-3" href="{{route('register')}}">SIGN UP</a>
            <a class="btn btn-purple my-2 my-sm-0" href="{{route('login')}}">LOG IN</a>
        </div>
        @endauth
        @endif
    </div>
</nav>