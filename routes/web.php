<?php

use App\Http\Controllers\UsersController;
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

Route::group(['prefix' => '/users'], static function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index');
    Route::get('/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('users.edit');
    Route::post('/store', [UsersController::class, 'store'])->name('users.store');
    Route::put('/update/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});
