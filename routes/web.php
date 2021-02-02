<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::post('/storeUser', [App\Http\Controllers\HomeController::class, 'storeUser'])->name('store');
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('create');
Route::get('/getUser', [App\Http\Controllers\HomeController::class, 'getUser'])->name('getUser');
Route::get('/delete/{id?}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('delete');
Route::post('/editUser/{user}', [App\Http\Controllers\HomeController::class, 'editUser'])->name('editUser');
Route::get('/edit_view/{id}', [App\Http\Controllers\HomeController::class, 'edit_view'])->name('edit_view');
Route::get('/fetchUser/{user}', [App\Http\Controllers\HomeController::class, 'fetchUser'])->name('fetchUser');

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
