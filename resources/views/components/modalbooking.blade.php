<!-- Modal de edición -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModalLabel">Editar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de reserva -->
                <form id="formBookingEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="booking_id" name="booking_id">

                    <div class="form-group mb-3">
                        <label for="workspace_id">Sala</label>
                        <select class="form-control" id="workspace_id" name="workspaces_id" required>
                            @foreach ($workspaces as $workspace)
                                <option value="{{ $workspace->id }}">{{ $workspace->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Fecha</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="hour">Hora</label>
                        <input type="time" class="form-control" id="hour" name="hour" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="user_name">Usuario</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" disabled>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
