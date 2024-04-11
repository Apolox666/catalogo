<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Group;
use App\Models\Subprocess;

class ServicesController extends Controller
{

    //este metodo redireciona a la vista de la tabla y envia los datos que se muestran en ella 
    public function index()
    {
        $servicios = Service::select('id', 'name', 'state', 'schedule', 'subprocesses_id', 'groups_id')
            ->where('state', 1)
            ->get();
        return (view('modulos/servicios.index', compact('servicios')));
    }

    //redirecciona a la vista create junto a los datos necesarios para crear el servicio
    public function create()
    {
        //estos dastos se muestran en el select del forumalrio create
        $subprocesos = Subprocess::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();

        //estos datos son iterados en radiobuttons en el formulario create
        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/servicios.create', compact('grupos', 'subprocesos')));
    }

    //registra un nuevo servicio
    public function store(Request $request)
    {

        //personaliza los mensajes de validacion de los campos
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'max' => 'El texto escrito es demsaido largo',
            'regex' => 'Este campo solo debe tener letras y espacios',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo solo debe contener letras y espacios.',
            'name.min' => 'El nombre instroducido es muy corto',
            // Añade más mensajes según tus necesidades
        ];

        //establece el tipo de validacion al campo
        $validator = $request->validate([
            'name' => ['required', 'min:4', 'string', 'max:40', 'regex:/^[a-zA-Z\s]+$/'],
            'hora_inicio' => ['required'],
            'hora_fin' => ['required'],
            'subprocess' => ['required'],
            'groups' => ['required'],

        ], $messages);

        try {
            $hi = $request->input('hora_inicio'); //los campos hora inicio/fin se unen en un string antes de guardarse
            $hf = $request->input('hora_fin');
            $horario_atencion = $hi . "-" . $hf;
            $servicios = new Service();
            $servicios->name = $request->input('name');
            $servicios->schedule = $horario_atencion;
            $servicios->state = 1;
            $servicios->subprocesses_id = $request->input('subprocess');
            $servicios->groups_id = $request->input('groups');
            $servicios->save();
            return redirect(route('service.index'))->with('success', 'Servicio creado');
        } catch (\Throwable $th) {
            return redirect(route('service.index'))->with('error', 'Error al crear servicio');
        }
    }

    //Esta funcion garantiza que un grupo esté ligado solo a un servicio
    public function checkGroupAvailability($groupId)
    {
        $group = Group::find($groupId);

        if (!$group) {
            return response()->json(['error' => 'Grupo no encontrado'], 404);
        }

        // Verificar si el grupo está asociado a algún servicio activo
        $isGroupInUse = $group->services()->where('state', 1)->exists();

        if ($isGroupInUse) {
            return response()->json(['message' => 'Grupo en uso'], 200);
        }

        return response()->json(['message' => 'Grupo disponible'], 200);
    }


    public function edit(string $id)
    {
        $subprocesos = Subprocess::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();

        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();

        $servicios = Service::findOrFail($id);
        return (view('modulos/servicios.edit', compact('servicios', 'subprocesos', 'grupos')));
    }

    //actualiza los datos del registro
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'max' => 'El texto escrito es demsaido largo',
            'regex' => 'Este campo solo debe tener letras y espacios',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo solo debe contener letras y espacios.',
            'name.min' => 'El nombre instroducido es muy corto',
            // Añade más mensajes según tus necesidades
        ];
        $validator = $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:40', 'regex:/^[a-zA-Z\s]+$/'],
            'hora_inicio' => ['required'],
            'hora_fin' => ['required'],
            'subprocess' => ['required'],
            'groups' => ['required'],

        ], $messages);


        $hi = $request->input('hora_inicio');
        $hf = $request->input('hora_fin');
        $servicios = Service::find($id);
        try {
            $horario_atencion = $hi . "-" . $hf;

            $servicios->name = $request->input('name');
            $servicios->schedule = $horario_atencion;
            $servicios->state = 1;
            $servicios->subprocesses_id = $request->input('subprocess');
            $servicios->groups_id = $request->input('groups');
            $servicios->save();
            return redirect(route('service.index'))->with('success', 'Servicio editado');
        } catch (\Throwable $th) {
            return redirect(route('service.index'))->with('error', 'Error al editar servicio');
        }
    }

    //establece el estado en 0 haciendo que se deje de mostrar el registro
    public function destroy(string $id)
    {
        $servicios = Service::findOrFail($id);
        $servicios->state = 0;
        $servicios->save();
        return $resulta = "ok";
    }
}
