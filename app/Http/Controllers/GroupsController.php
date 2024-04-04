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
        $groups = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/grupos.index', compact('groups')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $responsibles = Responsible::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/grupos.create', compact('responsibles')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'min' => 'El nombre instroducido es muy corto',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'responsible.required'  => 'El necesario seleccionar minimo un responsable para el grupo.',
            // Añade más mensajes según tus necesidades
        ];
        // Valida los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:30', 'min:4', 'regex:/^[a-zA-Z\s]+$/'],
            'responsibles' => 'required|array',
        ], $messages);

        // Crea un nuevo grupo
        try {
            $group = Group::create([
                'name' => $request->name,
    
            ]);
            $group->responsibles()->attach($request->responsibles);
            return redirect()->route('group.index')->with('success','Grupo creado');
        } catch (\Throwable $th) {
            return redirect()->route('group.index')->with('error','Error al crear grupo');
        }
       

        // Asocia los responsables seleccionados con el grupo
      
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
        return view('modulos/grupos.edit', compact('group', 'responsibles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $group = Group::findOrFail($id);


        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo  solo debe contener letras y espacios.',
            'min' => 'El nombre instroducido es muy corto',
        ];

        // Valida los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255|min:4|regex:/^[a-zA-ZñÑ\s]+$/',
            'responsibles' => 'array', // Asegura que al menos un responsable sea seleccionado
        ], $messages);

        // Actualiza los datos del grupo
        try {
            $group->update([
                'name' => $request->name,
            ]);
    
            // Actualiza las relaciones con los responsables
            $group->responsibles()->sync($request->responsibles);
    
            return redirect(route('group.index'))->with('success','Grupo editado');
        } catch (\Throwable $th) {
            return redirect(route('group.index'))->with('error','Error al editar grupo');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        $group->state = 0;
        $group->save();
        return $resulta = "ok";
    }
}
