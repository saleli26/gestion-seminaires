<?php
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\ProfileController;
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
});
Route::middleware(['auth'])->group(function () {
    Route::get('/etudiant/dashboard', function () {
        return view('etudiant');
    })->name('etudiant.dashboard');

    Route::get('/presentateur/dashboard', function () {
        return view('presentateur');
    })->name('presentateur.dashboard');

    Route::get('/secretaire/dashboard', function () {
        return view('secretaire');
    })->name('secretaire.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('seminaires', SeminaireController::class);
});

require __DIR__.'/auth.php';
