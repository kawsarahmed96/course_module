<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'create'])->name('submit');
Route::post('/form-submit', [MainController::class, 'store'])->name('form.submit');
