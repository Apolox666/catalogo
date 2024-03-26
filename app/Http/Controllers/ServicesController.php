<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Group;
use App\Models\Subprocess;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicios = Service::select('id', 'name', 'state', 'schedule', 'subprocesses_id', 'groups_id')
        ->where('state',1)
        ->get();
        return(view('modulos/servicios.index' , compact('servicios')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subprocesos = Subprocess::select('id', 'name', 'state')
        ->where('state',1)
        ->get();

        $grupos = Group::select('id', 'name', 'state')
        ->where('state', 1)
        ->get();
        return(view('modulos/servicios.create', compact('grupos', 'subprocesos')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $hi= $request-> input('hora_inicio');
        $hf =$request-> input('hora_fin');
        $horario_atencion = $hi."-".$hf;
        $servicios = new Service();
        $servicios ->name = $request ->input('name');
        $servicios ->schedule = $horario_atencion;
        $servicios -> state = 1;
        $servicios ->subprocesses_id= $request ->input('subprocess');
        $servicios->groups_id = $request->input('groups');
        $servicios ->save();
        return redirect(route('service.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subprocesos = Subprocess::select('id', 'name', 'state')
        ->where('state',1)
        ->get();

        $grupos = Group::select('id', 'name', 'state')
        ->where('state', 1)
        ->get();
        
        $servicios = Service::findOrFail($id);
        return(view('modulos/servicios.edit', compact('servicios', 'subprocesos', 'grupos')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $servicios = Service::findOrFail($id);
        $servicios -> state = 0;
        $servicios ->save();
        return $resulta = "ok";
    }
}
