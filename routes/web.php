<?php

use App\Http\Controllers\UserController;

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('usuarios', App\Http\Controllers\UserController::class)->names('user');
Route::resource('actividades', App\Http\Controllers\ActivitiesController::class)->names('activity');
Route::resource('grupos', App\Http\Controllers\GroupsController::class)->names('group');
Route::resource('servicios', App\Http\Controllers\ServicesController::class)->names('service');
Route::resource('productos', App\Http\Controllers\ProductController::class)->names('product');
Route::resource('responsables', App\Http\Controllers\ResponsibleControler::class)->names('responsible');



Route::middleware('auth')->group(function () {


    

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
