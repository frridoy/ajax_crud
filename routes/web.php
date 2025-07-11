<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CountryController::class, 'index'])->name('country.index');
Route::post('/country-store', [CountryController::class, 'store'])->name('country.store');
