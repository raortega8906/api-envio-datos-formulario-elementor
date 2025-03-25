<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

// Rutas Form
Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
Route::post('/receive-form', [FormController::class, 'receiveForm']);
Route::delete('/forms/delete-all', [FormController::class, 'destroyAllForms']);
Route::delete('/forms/{id}', [FormController::class, 'destroyForm']);
