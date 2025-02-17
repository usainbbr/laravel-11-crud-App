<?php

use App\Http\Controllers\customerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/customers/trash',[customerController::class,'trash'])->name('customers.tarsh');
Route::get('trash/restore/{customer}',[customerController::class,'restore'])->name('customers.restore');
Route::delete('customers/trash/{customer}',[customerController::class,'forceDeleted'])->name('customers.force.delete');
Route::resource('/customers',customerController::class);
  