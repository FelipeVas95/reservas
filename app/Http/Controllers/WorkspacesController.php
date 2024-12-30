<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Workspaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WorkspacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workspaces = Workspaces::all();
        return view('workspaces.index', compact('workspaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name_workspaces' => 'required|min:4|max:60',
            'description' => 'string|min:10|max:255',
        ]);

        DB::beginTransaction();

        try {
            Workspaces::create([
                'name' =>  $request->input('name_workspaces'),
                'description' => $request->input('description'),
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Reserva guardada correctamente.');

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
    public function edit($id)
    {
        //
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
        $workspace = Workspaces::findOrFail($id);

        $workspace->name = $request->name;
        $workspace->description = $request->description;
        $workspace->save();

        return redirect()->back()->with('success', 'Sala actualizada correctamente');
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
            $item = Workspaces::findOrFail($id);

            $item->delete();
            return redirect()->route('workspaces.index')->with('success', 'Registro eliminado correctamente.');
        } catch (\Exception $e) {

            return redirect()->route('workspaces.index')->withErrors('Error al eliminar el registro.');
        }
    }
}
