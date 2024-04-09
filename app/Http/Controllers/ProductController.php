<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Group;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Product::select('id', 'name', 'state', 'groups_id')
            ->where('state', 1)
            ->get();
        return (view('modulos/productos.index', compact('productos')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();
        return (view('modulos/productos.create', compact('grupos')));
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
            'min' => 'El nombre instroducido es muy corto',
            // Añade más mensajes según tus necesidades
        ];
        // Valida los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:30', 'min:4', 'regex:/^[a-zA-Z\s]+$/'],
            'groups' => ['required'],
        ], $messages);

        try {
            $producto = new Product();
            $producto->name = $request->input('name');
            $producto->state  = 1;
            $producto->groups_id = $request->input('groups');
            $producto->save();
            return redirect(route('product.index'))->with('success', 'Producto creado');
        } catch (\Throwable $th) {
            return redirect(route('product.index'))->with('error', 'error al crear producto');
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
        $producto = Product::findOrFail($id);
        $grupos = Group::select('id', 'name', 'state')
            ->where('state', 1)
            ->get();

        return view('modulos/productos.edit', compact('producto', 'grupos'));
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
            'min' => 'El nombre instroducido es muy corto',
            // Añade más mensajes según tus necesidades
        ];
        // Valida los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:30', 'min:4', 'regex:/^[a-zA-Z\s]+$/'],
            'groups' => ['required'],
        ], $messages);

        $producto = Product::findOrFail($id);
        try {

            $producto->name = $request->input('name');
            $producto->state  = 1;
            $producto->groups_id = $request->input('groups');
            $producto->save();
            return redirect(route('product.index'))->with('success', 'Producto editado');
        } catch (\Throwable $th) {
            return redirect(route('product.index'))->with('error', 'error al editar producto');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Product::findOrFail($id);

        $producto->state = 0;
        $producto->save();
        return $resulta = "ok";
    }
}
