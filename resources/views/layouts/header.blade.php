<header style="height: 60px">
    <nav class="navbar bg-primary" style="height: 60px" data-bs-theme="dark">
        <div class="container-fluid">
            <div class="col-md-2 d-flex justify-content-between align-items-center text-start" id="cont_bton_collap">
                <a id="name_app" class="button text-white" href="{{ route('home') }}">{{ config('app.name') }}</a>
                @auth
                    <button class="btn btn-primary mb-3" id="toggleSidebar">
                        <i id="icon_collapse" class="fas fa-bars"></i>
                    </button>
                @endauth
            </div>

            <div class="col-md-2 text-center">
                <button id="toggle-dark-mode" class="btn btn-primary mb-3">
                    <i id="icon-dark-mode" class="fas fa-moon"></i>
                </button>
            </div>
            @guest
                <div class="col-md-2 text-end">
                    <a class="button text-white" href="{{ route('login') }}">Iniciar Sesión</a>
                    |
                    <a class="button text-white" href="{{ route('register') }}">Registrate</a>
                </div>
            @endguest
            @auth
                <div class="content-center">

                    <div class="dropdown pb-1">

                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/000/550/980/small/user_icon_001.jpg"
                                alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown">

                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            @endauth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </div>
    </nav>
</header>
