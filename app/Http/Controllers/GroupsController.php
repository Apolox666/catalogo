<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Responsible;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = Group::all();
        return (view('grupos.index', compact('groups')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $responsibles = Responsible::all();
        return (view('grupos.create', compact('responsibles')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'responsible.required'  => 'El necesario seleccionar minimo un responsable para el grupo.',
            // Añade más mensajes según tus necesidades
        ];
        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'responsibles' => 'required|array',
        ], $messages);

        // Crea un nuevo grupo
        $group = Group::create([
            'name' => $request->name,

        ]);

        // Asocia los responsables seleccionados con el grupo
        $group->responsibles()->attach($request->responsibles);

        // Redirecciona a la página de inicio o donde sea adecuado
        return redirect()->route('group.index')->with('success', 'Grupo creado exitosamente.');
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
        $group = Group::findOrFail($id);
        $responsibles = Responsible::all();
        return view('grupos.edit', compact('group', 'responsibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $group = Group::findOrFail($id);

        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'responsibles' => 'array', // Asegura que al menos un responsable sea seleccionado
        ]);

        // Actualiza los datos del grupo
        $group->update([
            'name' => $request->name,
        ]);

        // Actualiza las relaciones con los responsables
        $group->responsibles()->sync($request->responsibles);

        return redirect(route('group.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Responsible::findOrFail($id);

        $group->delete();
        return $resulta = "ok";
    }
}
