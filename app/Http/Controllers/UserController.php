<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {

        $users = User::paginate();

        $usuarios = User::all();



        return view('modulos/usuarios.index', ['success' => true], compact('usuarios'));
    }

    public function create()
    {
        return view('modulos/usuarios.create');
    }




    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): RedirectResponse
    {
        $user = new User();

        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'min' => 'El nombre instroducido es muy corto',
            'password.min' => 'La contraseña debe tener minimo 8 caracteres',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'email.email' => 'Ingrese una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo electrónico ya está tomado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

        ];

        $validator = $request->validate([
            'name' => ['required', 'string', 'max:28', 'min:4', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required']
        ], $messages);

        try {

            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->save();
            Session::flash('success', 'El responsable se ha creado correctamente.');
            return redirect()->route('user.index')->with('success', 'El usuario ha sido creado.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el usuario.');
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


        $user = User::findOrFail($id);
        return view('modulos/usuarios.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        //Personalizo los mensajes de validacion segun el campo
        $messages = [
            'required' => 'Este campo es obligatorio.',
            'name.max' => 'El nombre introducido es muy largo',
            'name.regex' => 'El campo Nombre solo debe contener letras y espacios.',
            'email.email' => 'Ingrese una dirección de correo electrónico válida.',
            'password_confirmation.confirmed' => 'Las contraseñas no coinciden.',
            'password.confirmed' => 'Las contraseñas no coinciden.',

            // Añade más mensajes según tus necesidades
        ];

        $user = User::find($id);

        //establezco las validaciones para los campos
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:28', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);



        try {

            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');

            $user->save();
            return (redirect(route('user.index')));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Ha ocurrido un error al crear el usuario.');
        }
    }


    public function state(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->state = $request->state;
        $user->save();
    
        return response()->json(['message' => 'Estado actualizado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $resulta = "ok";
    }
}
