@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Bienvenido') }}</h3>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @csrf
                        <div class="container mt-4">
                            @auth
                                <div class="row">
                                    <!-- Card 1 -->
                                    <div class="col-md-4">
                                        <a href="{{ route('booking.create') }}" class="card text-decoration-none text-light">
                                            <div class="card-body text-center bg-primary">
                                                <h5 class="card-title"> <i class="fa-solid fa-person-shelter"> </i> Reservar
                                                    espacio</h5>
                                            </div>
                                        </a>
                                    </div>
                                    @can('gestionar salas')
                                        <!-- Card 2 -->
                                        <div class="col-md-4">
                                            <a href="{{ route('workspaces.index') }}" class="card text-decoration-none text-light">
                                                <div class="card-body text-center bg-danger">
                                                    <h5 class="card-title"> <i class="fa-regular fa-building"> </i> Gestionar salas
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    @endcan
                                    @can('gestionar reservas')
                                        <!-- Card 3 -->
                                        <div class="col-md-4">
                                            <a href="{{ route('booking.index') }}" class="card text-decoration-none text-light">
                                                <div class="card-body text-center bg-info">
                                                    <h5 class="card-title"> <i class="fa-solid fa-gears"> </i> Gestionar reservas
                                                    </h5>
                                                </div>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            @endauth
                            @guest
                                <div class="modal-footer d-flex justify-content-center">
                                    <h3> Registrate o inicia sesión para realizar las reservas</h3>
                                </div>
                                <div class="row modal-footer d-flex justify-content-center mt-3">
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p style="font-size:16px;font-weight: bold;font-style: italic;margin-top: 10px;">
                            Este sistema fue creado desde 0 en el Framework Laravel estrictamente por motivos educativos.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    @endsection
