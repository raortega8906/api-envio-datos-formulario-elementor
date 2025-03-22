<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('forms.index');
});

Route::get('/forms', [App\Http\Controllers\FormController::class, 'index'])->name('forms.index');
