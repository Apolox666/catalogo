<?php

namespace App\Http\Controllers;
use App\Models\Subprocess;

use Illuminate\Http\Request;

class SubprocessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subprocesos = Subprocess::select('id', 'name', 'state')
        ->where('state',1)
        ->get();
        return view('modulos/subprocesos.index' ,compact('subprocesos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modulos/subprocesos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $subproceso = new Subprocess();
        $subproceso -> name = $request->input('name');
        $subproceso -> state = 1;
        $subproceso ->save();
        return redirect()->route('subprocess.index');
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
        return view('modulos/subprocesos.edit');
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
        $subprocess = Subprocess::findOrFail($id);

        try {
            $subprocess->state = 0;
            $subprocess->save();
            return response()->json(['message' => 'El responsable ha sido eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el responsable.');
           
        }
    }
}
