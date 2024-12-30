@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            {{ Breadcrumbs::render('workspaces') }}
        </ol>
    </nav>
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-header">
                <h3>{{ __('Gestion de salas') }}</h3>
            </div>
            @can('gestionar salas')
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="form-group button mb-3">
                            <button type="submit" class="btn btn-primary fw-bold" data-bs-toggle="modal"
                                data-bs-target="#createModal">
                                <i class="fa-regular fa-plus fa-lg fw-bold"></i> {{ __('Agregar Sala') }}
                            </button>
                        </div>
                        <div class="form-group button mb-3">
                            <table class="table table-striped table-hover table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th colspan="2">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($workspaces->isEmpty())
                                        <tr>
                                            <td colspan="7">Sin registros</td>
                                        </tr>
                                    @else
                                        @foreach ($workspaces as $workspace)
                                            <tr>
                                                <td>{{ $workspace->id }}</td>
                                                <td>{{ $workspace->name }}</td>
                                                <td>{{ $workspace->description }}</td>
                                                <td><button type="submit" title="Editar"
                                                        onclick="editWorkspace({{ $workspace->id }}, '{{ $workspace->name }}', '{{ $workspace->description }}')"
                                                        style="background: none; border: none; color: inherit; cursor: pointer;"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                            class="fa-regular fa-pen-to-square fa-lg mt-2"></i></button></td>
                                                <td>
                                                    <form action="{{ route('workspaces.delete', $workspace->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Eliminar"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este elemento? Se eliminaran todos los registros vinculados a esta sala.')"
                                                            style="background: none; border: none; color: inherit; cursor: pointer;">
                                                            <i class="fa-regular fa-trash-can fa-lg mt-2"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
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
            @endcan
        </div>
        @include('components.modal')
        @include('components.modaledit')
    </div>
    <script>
        function editWorkspace(id, name, description) {
            document.getElementById('workspace_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('description_edit').value = description;

            var form = document.getElementById('formModal_edit');
            form.action = "/workspace_update/" + id;
        }
    </script>
@endsection
