<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Service;
use App\Models\Group;
use App\Models\Product;
use App\Models\Subprocess;

class ActivitiesController extends Controller
{
    //redirecciona a la vista de la tabla
    public function index()
    {
        $actividades = Activity::where('state', 1)
            ->with(['group' => function ($query) {
                $query->where('state', 1);
            }])
            ->get();

        return view('modulos/actividades.index', compact('actividades'));
    }

    //redirecciona al formato para crear la actividad
    public function create()
    {

        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/actividades.create', compact('grupos')));
    }

    //esta funcion registra la actividad
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'min' => 'El nombre instroducido es muy corto',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'not_in' => 'Por favor, seleccione una opción válida.',
        ];


        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:30'],
            'groups' => 'required',
            'priority' => 'required',
            'time_type' => 'required',
            'time_hours' => 'required_without:time_days',
            'time_days' => 'required_without:time_hours',
        ], $messages);



        // Crea un nuevo grupo
        try {
            $activity = new Activity();
            $activity->name = $request->name;
            $activity->groups_id = $request->groups; // Asigna el ID del grupo seleccionado
            $activity->priority = $request->input('priority');
            if ($request->input('time_type') == 'hours') {
                $activity->time = $request->input('time_hours');
            } elseif ($request->input('time_type') == 'days') {
                $activity->time = $request->input('time_days');
            }
            $activity->state = 1;
            $activity->save();

            return redirect(route('activity.index'))->with('success', 'Actividad creada.');
        } catch (\Throwable $th) {
            return redirect(route('activity.index'))->with('success', 'Error al  crear actividad.');
        }
    }

    //esta funcion lo que hace es realizar la consulta de las actividades y enviarlas a la vista de los detalles de la actividad
    public function show($id)
    {
        $activity = Activity::where('id', $id)
            ->with(['group' => function ($query) {
                $query->where('state', 1)
                    ->with(['responsibles' => function ($query) {
                        $query->where('state', 1); // Filtrar responsables activos
                    }])
                    ->with(['services' => function ($query) {
                        $query->where('state', 1)
                            ->with(['subprocess' => function ($query) {
                                $query->where('state', 1); // Filtrar subprocesos activos
                            }]);
                    }]);
            }])
            ->firstOrFail();

        return view('modulos.actividades.show', compact('activity'));
    }


    public function edit(string $id)
    {
        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        $actividades = Activity::findOrFail($id);
        return (view('modulos/actividades.edit', compact('actividades', 'grupos')));
    }


    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'min' => 'El nombre instroducido es muy corto',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'not_in' => 'Por favor, seleccione una opción válida.',
            'time_type.required' => "Seleccione una opcion",
        ];


        $request->validate([
            'name' => 'required|string|max:355|min:4',
            'groups' => 'required',
            'priority' => 'required',
            'time_type' => 'required',
            'time_hours' => 'required_without:time_days',
            'time_days' => 'required_without:time_hours',
        ], $messages);

        $activity = Activity::find($id);

        try {
            $activity->name = $request->name;
            $activity->groups_id = $request->groups; // Asigna el ID del grupo seleccionado
            $activity->priority = $request->input('priority');
            if ($request->input('time_type') == 'hours') {
                $activity->time = $request->input('time_hours');
            } elseif ($request->input('time_type') == 'days') {
                $activity->time = $request->input('time_days');
            }
            $activity->state = 1;

            $activity->save();

            return redirect(route('activity.index'))->with('success', 'Actividad editada.');
        } catch (\Throwable $th) {
            return redirect(route('activity.index'))->with('error', 'Error al editar.');
        }
    }


    //este metodo es el encargado realizar el filtro y la consulta de las actividades que se muestran en el home 
    public function search(Request $request)
    {
        //recibe los terminos ingresados en el input
        $searchTerm = $request->input('search');
        // Obtener el ID del producto seleccionado
        $productId = $request->input('product_id'); 
    
        // Iniciar la consulta de actividades
        $query = Activity::query();
    
        // Aplicar filtro por término de búsqueda si se proporciona
        if (!empty($searchTerm)) {
            
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }
    
        

        // Aplicar filtro por ID de producto si se selecciona un producto
        if (!empty($productId)) {
            // Obtener los IDs de los grupos asociados al producto seleccionado
            
            $groupIds = Product::find($productId)->group()->pluck('id')->toArray();
    
            // Filtrar por los grupos asociados al producto
            $query->whereHas('group', function ($q) use ($groupIds) {
                $q->whereIn('id', $groupIds)->where('state', 1);
            });
        }
    
        // Aplicar filtro para obtener solo actividades con estado 1
        $query->where('state', 1);
    
        // Obtener las actividades filtradas
        $activities = $query->get();
    
        // Devolver las actividades como JSON para la respuesta AJAX
        return response()->json(['activities' => $activities]);
    }




    //coloca en estado 0 la actividad
    public function destroy(string $id)
    {
        $actividades = Activity::findOrFail($id);
       
        $actividades->state = 0;
        $actividades->save();
        return $resulta = "ok";
    }
}
