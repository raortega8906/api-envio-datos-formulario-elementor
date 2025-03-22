<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
Route::post('/recibir-formulario', [FormController::class, 'recibirFormulario']);