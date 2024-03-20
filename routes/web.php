<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/* Las llamadas a los controladores User, product, services,  responsibles, no son necesarias si se llaman en el propio codigo*/


/* Esta ruta establece la pantalla que verá el usuario cuando entre a mi pagina*/

Route::get('/', function () {
    return view('home');
});

/* Esta ruta valida que el usuaro esté logueado para pasarlo al dashboard admin */
Route::get('/dashboard', function () {
    $groups = App\Models\Group::where('state',1)->count();
    $responsible = App\Models\Responsible::where('state',1)->count();
    $activity = App\Models\Activity::where('state',1)->count();
    return view('dashboard', ['groups'=>$groups, 'responsible'=>$responsible, 'activity'=>$activity]);
})->middleware(['auth', 'verified'])->name('dashboard');

/* Estas rutas son las llamadas de los controladores resources que facilitan los CRUD usados */
/* El atribute names establece la manera en que voy a referenciar el controlador para acceder a sus metodos */
Route::resource('usuarios', App\Http\Controllers\UserController::class)->names('user');
Route::resource('actividades', App\Http\Controllers\ActivitiesController::class)->names('activity');
Route::resource('grupos', App\Http\Controllers\GroupsController::class)->names('group');
Route::resource('servicios', App\Http\Controllers\ServicesController::class)->names('service');
Route::resource('productos', App\Http\Controllers\ProductController::class)->names('product');
Route::resource('responsables', App\Http\Controllers\ResponsibleController::class)->names('responsible');
Route::resource('subprocesos', App\Http\Controllers\SubprocessController::class)->names('subprocess');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
