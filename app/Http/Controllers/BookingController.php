<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Workspaces;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find(Auth::id());
        $rol = $user->hasRole('administrador');

        $workspaceId = $request->input('workspace_id');
        $workspaces = Workspaces::all();

        $query = Booking::join('workspaces', 'booking.workspaces_id', '=', 'workspaces.id')
            ->join('users', 'booking.users_id', '=', 'users.id')
            ->select(
                DB::raw('DATE(booking.date) as booking_date'),
                'booking.*',
                'workspaces.name as workspaces_name',
                'users.name as users_name'
            );

        if (!$rol) {
            $query->where('booking.users_id', '=', Auth::id());
        }

        if ($workspaceId) {
            $query->where('workspaces.id', '=', $workspaceId);
        }

        $booking = $query->get();

        return view('booking.view', compact('booking', 'workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workspaces = Workspaces::all();
        return view('booking.create', compact('workspaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'workspaces_id' => 'required|exists:workspaces,id',
            'date_booking' => 'required|date|after:today',
            'hour' => 'required|date_format:H:i',
        ]);

        $workspaces_id = $request->input('workspaces_id');
        $date = $request->input('date_booking');
        $hour = date($request->input('hour'));

        DB::beginTransaction();
        try {
            // Verificar si hay conflictos de horarios
            $booking = new Booking();
            $booking->date = $date;
            $booking->fill($request->only(['workspaces_id', 'hour']));
            $conflict = $this->findConflict($booking);

            if ($conflict) {
                throw new \Exception('No se pudo guardar, cruce de horarios');
            } else {
                Booking::create([
                    'users_id' => Auth::id(),
                    'workspaces_id' => $workspaces_id,
                    'date' => $date,
                    'hour' => $hour,
                ]);

                DB::commit();
                return redirect()->back()->with('success', 'Tu reserva se ha registrado correctamente y estara pendiente hasta que un administrador la revise.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $status)
    {
        DB::beginTransaction();

        try {
            // Buscar el registro que se va a actualizar

            $booking = Booking::findOrFail($id);
            $conflict = $this->findConflict($booking);

            if (!$conflict) {
                $booking->status = $status == 0 ? 'Rechazada' : 'Aceptada';

                $booking->save();
                DB::commit();
                return redirect()->route('booking.index')->with('success', 'Reserva actualizada correctamente');
            } else {
                throw new \Exception('No se pudo guardar, cruce de horarios');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscar la reserva por ID
        $booking = Booking::findOrFail($id);

        $booking->workspaces_id = $request->workspaces_id;
        $booking->date = $request->date;
        $booking->hour = $request->hour;

        $booking->save();

        return redirect()->back()->with('success', 'Reserva actualizada correctamente');
    }

    /**
     * Verifica si existe un conflicto de horarios para una reserva dada.
     *
     * Este método verifica si hay conflictos de horarios con otras reservas 
     * en el mismo espacio de trabajo y fecha, excluyendo la reserva actual 
     * (identificada por su ID) para evitar conflictos consigo misma.
     *
     * @param Booking $booking La instancia de Booking que contiene los datos de la reserva a verificar.
     * 
     * @return bool Devuelve true si se detecta un conflicto de horario; de lo contrario, devuelve false.
     */

    public function findConflict(Booking $booking)
    {

        $workspaces_id = $booking->workspaces_id;
        $date = $booking->date;
        $hour = $booking->hour;
        $id = $booking->id;

        $booking = Booking::where('workspaces_id', $workspaces_id)
            ->where('date', $date)
            ->where('status', 'Aceptada')
            ->where('id', '!=', $id)
            ->get();

        $conflict = false;

        //verifica cruce horas
        foreach ($booking as $book) {
            $start_hour = $book->hour;
            $end_date = date('H:i', strtotime($start_hour . ' +1 hour'));
            if ($hour >= $start_hour && $hour <= $end_date) {
                $conflict = true;
            }
        }
        return $conflict;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Buscar el registro a eliminar
            $item = Booking::findOrFail($id);

            $item->delete();

            return redirect()->route('booking.index')->with('success', 'Registro eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('booking.index')->withErrors('Error al eliminar el registro.');
        }
    }
}
