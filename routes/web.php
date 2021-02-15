<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;

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



// Admin
Route::group(['middleware' => 'admin'], function (){
    Route::get('/admin/book',[ BookController::class , 'indexAdminBookUnapproved'])->name('admin.book.index');
    Route::get('/admin/book/{book}/{status}',[ BookController::class , 'bookChangeApproved'])->name('admin.book.change.approved');
});
// Auth
Auth::routes();
Route::middleware( 'auth')->group( function(){
    Route::resource('/book',  BookController::class)->only([
        'store',
        'create',
        'update',
        'edit',
        'destroy'
    ]);

    Route::get('/book/myBooks', [BookController::class, 'getAllUserBooks'])->name('userBook');

    Route::get('/report/index', [ReportController::class, 'index'])->name('report.index');
    Route::post('/report/store/{book_id}', [ReportController::class, 'store'])->name('report.store');
    Route::get('/report/show/{report}', [ReportController::class, 'show'] )->name('report.show');

    Route::post('/report/message/store/{report}', [ReportController::class ,'reportMessageStore'])->name('report.message.store');
    
    
    //Review
    Route::post('/review/store/{book_id}/{user_id}', [ReviewController::class, 'store' ])->name('review.store');
    Route::post('/review/index/{book_id}', [ReviewController::class, 'index' ])->name('review.index');

});
// Guest
Route::resource('/book', BookController::class)->only([
    'index',
    'show'
]);
Route::get('/books', [BookController::class , 'search'])->name('books.search');
Route::get('/', function(){
    return redirect()->route('book.index');
});

