<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Formulario de Salas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario en el modal -->
                <form id="formModal" action={{ route('workspaces.create') }} method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name_workspaces">Nombre de la sala</label>
                        <input id="name_workspaces" type="text"
                            class="form-control @error('name_workspaces') is-invalid @enderror" name="name_workspaces"
                            value="{{ old('name_workspaces') }}" autocomplete="name_workspaces" required>
                    </div>
                    <div class="mb-3">
                        <label for="description">Descripción</label>
                        <input id="description" type="text"
                            class="form-control @error('description') is-invalid @enderror" name="description"
                            value="{{ old('description') }}" autocomplete="description" >
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" form="formModal" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
