@auth
<div class="container-fluid">
    <div class="row flex-nowrap" style="height: calc(100vh - 60px);">
        <!-- Menú lateral -->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white" style="height: 100vh;">
                <!-- Botón para contraer/expandir en pantallas pequeñas -->
                <button class="btn btn-dark d-md-none mb-3" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-expanded="false" aria-controls="sidebarMenu">
                    <i class="fas fa-bars"></i> Menú
                </button>

                <!-- Contenido del menú -->
                <div class="collapse d-md-block" id="sidebarMenu">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline"><a class="navbar-brand" href="{{ route('home') }}">TW Group</a></span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                                <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-gears"></i> <span class="ms-1 d-none d-sm-inline">Gestionar Reservas</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="{{ route('booking.create') }}" class="nav-link px-0">
                                        <span class="d-none d-sm-inline">Crear</span> reserva
                                    </a>
                                </li>
                                @can('gestionar salas')
                                <li>
                                    <a href="{{ route('booking.index') }}" class="nav-link px-0">
                                        <i class="fa-regular fa-building"></i>
                                        <span class="d-none d-sm-inline">Aprobar</span> reserva
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('workspaces.index') }}" class="nav-link px-0 align-middle">
                                <i class="fa-regular fa-building"></i> <span class="ms-1 d-none d-sm-inline">Gestionar Salas</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
@endauth
        <!-- Contenido principal -->
        <div class="col py-3">
            @yield('content')
        </div>
    </div>
</div>
