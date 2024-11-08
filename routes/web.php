<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExportContactsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('contacts', ContactController::class);
    Route::get('/export-contacts-to-csv', ExportContactsController::class)->name('export-contacts-to-csv');
    Route::put('/contacts/{contact}/toggle-favorite', [ContactController::class, 'toggleFavorite'])
        ->name('contacts.toggleFavorite');



    Route::controller(TrashContactController::class)->group(function () {
        Route::prefix('trash')->group(function () {
            Route::name('contacts.')->group(function () {
                Route::get('/',  'trash')->name('trash');
                Route::post('/restore/{contact}', 'restore')->withTrashed()->name('restore');
                Route::post('/restore-all', 'restoreAll')->withTrashed()->name('restore-all');
                Route::delete('/force-delete/{contact}', 'forceDelete')->withTrashed()->name('force-delete');
                Route::delete('/force-delete-all', 'forceDeleteAll')->name('forceDeleteAll');
            });
        });
    });
});

require __DIR__.'/auth.php';
