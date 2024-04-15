<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivitiesController;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Product;
use App\Http\Controllers\UserController;





Route::get('/', function () {
    $products = Product::select('id', 'name', 'state', 'groups_id')
        ->where('state', 1)
        ->get();

    return view('home', compact('products'));
})->name('home');


/*con esta ruta se da entrada al dashboard y se envian los datos que se muestran en el*/ 
Route::get('/dashboard', function () {
    $groups = App\Models\Group::where('state', 1)->count();
    $responsible = App\Models\Responsible::where('state', 1)->count();
    $activity = App\Models\Activity::where('state', 1)->count();
    $product = \App\Models\Product::select('id', 'name', 'state')->where('state',1)->get();
    $service = App\Models\Service::where('state', 1)->count();
    return view('dashboard', ['groups' => $groups, 'responsible' => $responsible, 'activity' => $activity, 'service' => $service, 'product' => $product]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/user/state/{id}', [UserController::class, 'state'])->name('user.state');
/*Este grupo de rutas se encarga de los diferentes modulos del aplicativo*/


Route::put('/user/{id}/state', [UserController::class, 'state'])->name('user.state');
Route::resource('usuarios', App\Http\Controllers\UserController::class)->names('user')->middleware('auth');
Route::resource('actividades', App\Http\Controllers\ActivitiesController::class)->names('activity')->middleware('auth');
Route::resource('grupos', App\Http\Controllers\GroupsController::class)->names('group')->middleware('auth');
Route::resource('servicios', App\Http\Controllers\ServicesController::class)->names('service')->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductController::class)->names('product')->middleware('auth');
Route::resource('responsables', App\Http\Controllers\ResponsibleController::class)->names('responsible')->middleware('auth');
Route::resource('subprocesos', App\Http\Controllers\SubprocessController::class)->names('subprocess')->middleware('auth');
Route::get('/search', [ActivitiesController::class, 'search'])->name('activity.search');
Route::get('/activities/{id}', [ActivitiesController::class, 'show'])->name('activity.show');



/* Este grupo de rutas se encargan del perfil del usuario logueado*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
