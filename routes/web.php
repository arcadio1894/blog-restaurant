<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('blog/get/welcome/posts/{number_page}', [PostController::class, 'getDataWelcomePosts'])->name('post.get.welcome');

Route::get('/about', [WelcomeController::class, 'about'])->name('welcome.about');

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function (){
    Route::prefix('blog')->group(function (){

        // TODO: Rutas módulo Blog
        Route::get('/listado', [PostController::class, 'index'])->name('post.index');

        Route::get('/get/data/posts/{number_page}', [PostController::class, 'getDataPosts'])->name('post.get');


        Route::get('/crear', [PostController::class, 'create'])->name('post.create');

        Route::post('/save', [PostController::class, 'store'])->name('post.store');

        Route::post('/destroy/post/{post_id}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
