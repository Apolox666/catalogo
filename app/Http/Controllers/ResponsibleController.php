<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Responsible;


class ResponsibleController extends Controller
{
    //muestra la vista de la tabla con los datos mostrados en ella
    public function index()
    {
        $responsibles = Responsible::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();

        return (view('modulos/responsables.index', compact('responsibles')));
    }

    //muestra el formulario para crear un nuevo registro
    public function create()
    {
        return (view('modulos/responsables.create'));
    }

    //registra un nuevo responsable
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'max' => 'El texto escrito es demsaido largo',
            'regex' => 'Este campo solo debe tener letras y espacios',
            'first_name.max' => 'El nombre introducido es muy largo',
            'first_name.regex' => 'El campo solo debe contener letras y espacios.',
            'min' => 'El nombre instroducido es muy corto',

            // Añade más mensajes según tus necesidades
        ];
        $validator = $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z\s]+$/'],
            'first_surname' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z\s]+$/'],
            'second_name' => ['max:20',  'min:3', 'regex:/^[a-zA-Z\s]+$/', 'nullable'],
            'second_surname' => ['required', 'string',  'min:3', 'max:20', 'regex:/^[a-zA-Z\s]+$/'],
        ], $messages);

        //aqui se toman los campos del formulario y se unen en un string haciendo cada primer letra mayuscula
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
            $responsible->state = 1;
            $responsible->save();
            return redirect()->route('responsible.index')->with('success', 'Responsable creado.');
        } catch (\Exception $e) {
            return redirect()->route('responsible.index')->with('error', 'Error al crear responsable.');

        }
    }


    
    public function edit(string $id)
    {
        $responsible = Responsible::findOrFail($id);
        return (view('modulos/responsables.edit', compact('responsible')));
    }

    
    public function update(Request $request, string $id)
    {

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'min' => 'El nombre instroducido es muy corto',
        ];

        $responsible = Responsible::find($id);

        $validator = $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:28', 'regex:/^[a-zA-ZñÑ\s]+$/'],
        ], $messages);

        // Verificar la unicidad del correo electrónico excluyendo el usuario actual

        // Actualizar otros campos
        try {
            $responsible->name = $request->input('name');
            $responsible->state = 1;
            $responsible->save();
            return redirect()->route('responsible.index')->with('success', 'Responsable editado.');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al editar el responsable.');
        }


        // Redireccionar o realizar otras acciones después de la actualización

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Responsible::findOrFail($id);

        try {
            $user->state = 0;
            $user->save();
            return response()->json(['message' => 'El responsable ha sido eliminado correctamente'], 200);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el responsable.');
        }
    }
}
