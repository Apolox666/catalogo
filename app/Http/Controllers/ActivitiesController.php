<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Service;
use App\Models\Group;
use App\Models\Subprocess;

class ActivitiesController extends Controller
{

    public function index()
    {
        $actividades = Activity::where('state', 1)
            ->with(['group' => function ($query) {
                $query->where('state', 1);
            }])
            ->get();

        return view('modulos/actividades.index', compact('actividades'));
    }


    public function create()
    {

        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/actividades.create', compact('grupos')));
    }


    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'not_in' => 'Por favor, seleccione una opción válida.',
        ];


        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'groups' => 'required',
            'priority' => 'required',
            'time_type' => 'required',
            'time_hours' => 'required_without:time_days',
            'time_days' => 'required_without:time_hours',
        ], $messages);



        // Crea un nuevo grupo
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

        return redirect(route('activity.index'));
    }


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
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'not_in' => 'Por favor, seleccione una opción válida.',
        ];


        $request->validate([
            'name' => 'required|string|max:355',
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

            return redirect(route('activity.index'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }



    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $activities = Activity::where('name', 'like', '%' . $searchTerm . '%')
            ->where('state', 1)
            ->with('group')
            ->get();

        return response()->json(['activities' => $activities]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $actividades = Activity::findOrFail($id);
        $actividades->state = 0;
        $actividades->save();
        return $resulta = "ok";
    }
}
