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
Route::middleware('remembercachekeys')->get('/', [BlogController::class, 'index'])->name('home');



//Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * a resource generates these routes
     *
    Verb          Path                        Action  Route Name
    GET           /posts                      index   posts.index
    GET           /posts/create               create  posts.create
    POST          /posts                      store   posts.store
    GET           /posts/{post}               show    posts.show
    GET           /posts/{post}/edit          edit    posts.edit
    PUT|PATCH     /posts/{post}               update  posts.update
    DELETE        /posts/{post}               destroy posts.destroy */

    Route::resource('posts', PostController::class);

});

