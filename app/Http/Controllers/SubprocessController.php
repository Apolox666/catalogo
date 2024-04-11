<?php

namespace App\Http\Controllers;
use App\Models\Subprocess;

use Illuminate\Http\Request;

class SubprocessController extends Controller
{
    //redirecciona a la vista de la tabla
    public function index()
    {
        //se obtienen los datos que mostraré y se envian a la vista
        $subprocesos = Subprocess::select('id', 'name', 'state')
        ->where('state',1)
        ->get();
        return view('modulos/subprocesos.index' ,compact('subprocesos'));
    }

   
    public function create()
    {
        return view('modulos/subprocesos.create');
    }

    //esta funcion guarda nuevo registros
    public function store(Request $request)
    {
        //personaliza los mensajes de validacion por campo
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'name.min' => 'El nombre instroducido es muy corto',
           
            
        ];
       
        //establezco las validaciones del campo
        $request->validate([
            'name' => ['required', 'string', 'max:30','min:4', 'regex:/^[a-zA-Z\s]+$/'],
        ], $messages);

    
        //guardo los datos
        try {
            $subproceso = new Subprocess();
            $subproceso -> name = $request->input('name');
            $subproceso -> state = 1;
            $subproceso ->save();
            return redirect()->route('subprocess.index')->with('success', 'Subproceso creado');
        } catch (\Throwable $th) {
            return redirect()->route('subprocess.index')->with('error', 'Error al crear subproceso');
        }
       
    }

    public function edit(string $id)
    {
        $subproceso = Subprocess::findOrFail($id);
        return view('modulos/subprocesos.edit', compact('subproceso'));
    }

    //esta funcion actualiza los datos
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'name.min' => 'El nombre instroducido es muy corto',
            // Añade más mensajes según tus necesidades
        ];
        
        // Valida los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:30', 'min:4', 'regex:/^[a-zA-Z\s]+$/'],
           
        ], $messages);
        
        try {
            $subproceso = Subprocess::findOrFail($id);
            $subproceso -> name = $request->input('name');
            $subproceso -> state = 1;
            $subproceso ->save();
            return redirect()->route('subprocess.index')->with('success', 'Subproceso editado');
        } catch (\Throwable $th) {
            return redirect()->route('subprocess.index')->with('error', 'error al editar subproceso');
        }
    }

    //se encarga de colocar el estado del subproceso a 0 para no ser visualizado 
    public function destroy(string $id)
    {
        $subprocess = Subprocess::findOrFail($id);

        try {
            $subprocess->state = 0;
            $subprocess->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el responsable.');
           
        }
    }
}
