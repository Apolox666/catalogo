<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Group;

class ActivitiesController extends Controller
{

    public function index()
    {
        $actividades = Activity::with('group')->get();
        return (view('actividades.index', compact('actividades')));

    }


    public function create()
    {
        
        $grupos = Group::all();
        return (view('actividades.create', compact('grupos')));
    }


    public function store(Request $request)
    {
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            
        ];
       
        $request->validate([
            'name' => 'required|string|max:255',
            'groups' => 'required',
            'time' => 'required',
            'priority' =>'required',

        ], $messages);


        // Crea un nuevo grupo
        $activity = new Activity();
        $activity->name = $request->name;
        $activity->groups_id = $request->groups; // Asigna el ID del grupo seleccionado
        $activity->priority = $request->input('priority');
        $activity->time = $request->input('time');
        $activity->save();

        return redirect(route('activity.index'));
    }

  
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        $actividades = Activity::all();
        return(view('actividades.edit', compact('actividades')));
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
