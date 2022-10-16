<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';


//Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
});


//Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    /**
     * a resource generates these routes
     *
    Verb          Path                        Action  Route Name
    GET           /users                      index   users.index
    GET           /users/create               create  users.create
    POST          /users                      store   users.store
    GET           /users/{user}               show    users.show
    GET           /users/{user}/edit          edit    users.edit
    PUT|PATCH     /users/{user}               update  users.update
    DELETE        /users/{user}               destroy users.destroy */

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);

});

