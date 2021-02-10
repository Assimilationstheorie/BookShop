<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
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

Auth::routes();
//
Route::group(['middleware' => 'auth'], function(){
    Route::resource('/book', App\Http\Controllers\BookController::class);

    Route::get('/book/myBooks/{id}', [App\Http\Controllers\BookController::class, 'getAllUserBooks'])->name('userBook');
});






