<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\teste;
use App\Http\Controllers\SiteController;

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/consulta-cep', [SiteController::class, 'consulta_-ep'])->name('consulta-cep');
Route::get('/bandeiras', [SiteController::class, 'bandeiras'])->name('bandeiras');