@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header" class="fw-bold">
                <h3>{{ __('Reserva de espacios') }}</h3>
            </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('booking.save') }}">
                        <div class="row">
                            @csrf
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="form-group mt-1">
                                        <label for="workspaces_id" class="fw-bold mb-1">Salas</label>
                                        <select name="workspaces_id" id="workspaces_id"
                                            class="form-control @error('workspaces_id') is-invalid @enderror" required>
                                            <option value="" selected disabled>Selecciona la sala</option>
                                            @foreach ($workspaces as $workspace)
                                                <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="form-group mt-1">
                                                <label for="date_booking" class="fw-bold mb-1">Fecha</label>
                                                <input id="date_booking" type="date"
                                                    class="form-control @error('date_booking') is-invalid @enderror"
                                                    name="date_booking" value="{{ old('date_booking') }}" required
                                                    autocomplete="date_booking">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6 col-lg-6">
                                            <div class="form-group mt-1">
                                                <label for="hour" class="fw-bold mb-1">Hora</label>
                                                <input id="hour" type="time"
                                                    class="form-control @error('hour') is-invalid @enderror" name="hour"
                                                    value="{{ old('hour') }}" required autocomplete="hour">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <div class="form-group button">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Guardar') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    @endsection
