<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivitiesController;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Product;



/* Esta ruta establece la pantalla que verá el usuario cuando entre a mi pagina*/

Route::get('/', function () {
    $products = Product::all(); // Obtener todos los productos desde la base de datos

    // Pasar la variable $products a la vista 'home'
    return view('home', ['products' => $products]);
})->name('home');

/* Esta ruta valida que el usuaro esté logueado para pasarlo al dashboard admin */
Route::get('/dashboard', function () {
    $groups = App\Models\Group::where('state',1)->count();
    $responsible = App\Models\Responsible::where('state',1)->count();
    $activity = App\Models\Activity::where('state',1)->count();
    $service = App\Models\Service::where('state',1)->count();
    return view('dashboard', ['groups'=>$groups, 'responsible'=>$responsible, 'activity'=>$activity, 'service'=>$service]);
})->middleware(['auth', 'verified'])->name('dashboard');


/* El atribute names establece la manera en que voy a referenciar el controlador para acceder a sus metodos */
Route::resource('usuarios', App\Http\Controllers\UserController::class)->names('user')->middleware('auth');
Route::resource('actividades', App\Http\Controllers\ActivitiesController::class)->names('activity')->middleware('auth');
Route::resource('grupos', App\Http\Controllers\GroupsController::class)->names('group')->middleware('auth');
Route::resource('servicios', App\Http\Controllers\ServicesController::class)->names('service')->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductController::class)->names('product')->middleware('auth');
Route::resource('responsables', App\Http\Controllers\ResponsibleController::class)->names('responsible')->middleware('auth');
Route::resource('subprocesos', App\Http\Controllers\SubprocessController::class)->names('subprocess')->middleware('auth');
Route::get('/search', [ActivitiesController::class, 'search'])->name('activity.search');
Route::get('/activities/{id}', [ActivitiesController::class, 'show'])->name('activity.show');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
