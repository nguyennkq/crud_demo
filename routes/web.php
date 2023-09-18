<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('category/deleted', [CategoryController::class, 'deleted'])->name('category.deleted');

Route::delete('category/permanently/{id}', [CategoryController::class, 'permanentlyDelete'])->name('category.permanently.delete');

Route::get('/restore/{id}', [CategoryController::class, 'restore'])->name('category.restore');

Route::resource('category', CategoryController::class);
