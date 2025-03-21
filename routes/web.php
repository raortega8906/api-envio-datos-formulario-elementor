<?php

use Illuminate\Support\Facades\Route;

Route::get('/forms', function () {
    return view('welcome');
});

Route::get('/forms', [App\Http\Controllers\FormController::class, 'index'])->name('forms.index');
