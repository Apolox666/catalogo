<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsible;

class ResponsibleControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $responsibles = Responsible::all();
        
        return (view('responsables.index', compact('responsibles')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return (view('responsables.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'first_name.max' => 'El nombre introducido es muy largo',
            'first_name.regex' => 'El campo solo debe contener letras y espacios.',
            // Añade más mensajes según tus necesidades
        ];
        $validator = $request->validate([
            'first_name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
           
        ], $messages);
    
        $first_name = ucfirst($request->input('first_name'));
        $second_name = ucfirst($request->input('second_name'));
        $first_surname = ucfirst($request->input('first_surname'));
        $second_surname = ucfirst($request->input('second_surname'));
    
        // Construir el nombre completo
        $name = trim("$first_name $second_name $first_surname $second_surname");
    
        try {
            // Guardar el responsable en la base de datos
            $responsible = new Responsible();
            $responsible->name = $name;
            $responsible->save();
    
            return redirect()->route('responsible.index')->with('success', 'El responsable se ha creado correctamente.');
        } catch (\Exception $e) {
            // Manejar la excepción si ocurre algún error inesperado
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el responsable.');
        }
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
        $responsible = Responsible::findOrFail($id);
        return(view('responsables.edit', compact('responsible')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.', 
        ];

        $responsible = Responsible::find($id);

        $validator = $request->validate([
            'name' => ['required', 'string', 'max:28', 'regex:/^[a-zA-ZñÑ\s]+$/'],
        ], $messages);

        // Verificar la unicidad del correo electrónico excluyendo el usuario actual

        // Actualizar otros campos
        $responsible->name = $request->input('name');
        $responsible->save();

        // Redireccionar o realizar otras acciones después de la actualización
        return redirect(route('responsible.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Responsible::findOrFail($id);

        $user->delete();
        return $resulta = "ok";
    }
}
