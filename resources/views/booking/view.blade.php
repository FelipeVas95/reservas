@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ __('Gestion de reservas') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @csrf
                    <form action="{{ route('booking.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="workspace_id">Filtrar por sala:</label>
                                <select name="workspace_id" class="form-control" id="workspace_id">
                                    <option value="">Todas las salas</option>
                                    @foreach ($workspaces as $workspace)
                                        <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 align-self-end">
                                <button type="submit" class="btn btn-primary btn-sm">Filtrar</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuario</th>
                                <th>Sala</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                @can('gestionar reservas')
                                    <th>Acción</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($booking->isEmpty())
                                <tr>
                                    <td colspan="7">Sin registros</td>
                                </tr>
                            @else
                                @foreach ($booking as $booking_row)
                                    <tr>
                                        <td>{{ $booking_row->id }}</td>
                                        <td>{{ $booking_row->users_name }}</td>
                                        <td>{{ $booking_row->workspaces_name }}</td>
                                        <td>{{ $booking_row->booking_date }}</td>
                                        <td>{{ $booking_row->hour }}</td>
                                        <td>
                                            @if ($booking_row->status == 'Rechazada')
                                                <span class="badge bg-danger" style="cursor:default;">Rechazada</span>
                                            @elseif ($booking_row->status == 'Aceptada')
                                                <span class="badge bg-success" style="cursor:default;">Aceptada</span>
                                            @else
                                                <span class="badge bg-info" style="cursor:default;">Pendiente</span>
                                            @endif
                                        </td>
                                        @can('gestionar reservas')
                                            <td><button type="submit" title="Editar"
                                                    onclick="editBooking({{ $booking_row->id }}, '{{ $booking_row->workspaces_name }}', '{{ $booking_row->date }}', '{{ $booking_row->hour }}', '{{ $booking_row->users_name }}')"
                                                    style="background: none; border: none; color: inherit; cursor: pointer;"
                                                    data-bs-toggle="modal" data-bs-target="#editBookingModal"><i
                                                        class="fa-regular fa-pen-to-square fa-lg mt-2"></i>
                                                </button>
                                                &nbsp;
                                                <form action="{{ route('booking.delete', $booking_row->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Eliminar"
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento?.')"
                                                        style="background: none; border: none; color: inherit; cursor: pointer;">
                                                        <i class="fa-regular fa-trash-can fa-lg mt-2"></i>
                                                    </button>
                                                </form>
                                                &nbsp;
                                                <form
                                                    action="{{ route('booking.edit', ['booking_id' => $booking_row->id, 'status' => 1]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" title="Aprobar"
                                                        onclick="return confirm('¿Estás seguro de que deseas aprobar esta reserva?.')"
                                                        style="background: none; border: none; color: inherit; cursor: pointer;">
                                                        <i class="fas fa-check fa-lg" style="color: green"></i>
                                                    </button>
                                                </form>
                                                &nbsp;
                                                <form
                                                    action="{{ route('booking.edit', ['booking_id' => $booking_row->id, 'status' => 0]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <button type="submit" title="Rechazar"
                                                        onclick="return confirm('¿Estás seguro de que deseas rechazar esta reserva?.')"
                                                        style="background: none; border: none; color: inherit; cursor: pointer;">
                                                        <i class="fas fa-times fa-lg" style="color: red"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{-- Flashes de respuesta --}}
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
        </div>
    </div>
    @include('components.modalbooking')
@endsection

<script>
    function editBooking(id, workspace_name, date, hour, user_name) {
        // Establecer el ID de la reserva en el formulario oculto
        document.getElementById('booking_id').value = id;

        // Establecer los valores de los campos en el modal
        document.getElementById('workspace_id').value = workspace_name;
        document.getElementById('date').value = date;
        document.getElementById('hour').value = hour;
        document.getElementById('user_name').value = user_name;
        // Cambiar la URL del formulario a la URL dinámica con el ID de la reserva
        var form = document.getElementById('formBookingEdit');
        form.action = "/booking_update/" + id; // Cambiar por la ruta correcta de actualización
    }
</script>
