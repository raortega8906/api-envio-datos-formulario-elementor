<?php

use Illuminate\Support\Facades\Route;

// Nueva implementacion:
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return redirect()->route('forms.index');
});

// Nueva implementacion:

// Descarga
Route::get('/forms/download-view', [FormController::class, 'showDownloadView'])->name('forms.download.view');
Route::get('/forms/download', [FormController::class, 'downloadForms'])->name('forms.download');
