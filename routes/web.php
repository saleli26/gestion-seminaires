<?php
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretaireController;
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
    Route::get('/secretaire/dashboard', function () {
        return view('secretaire');
    })->name('secretaire.dashboard');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('seminaires', SeminaireController::class);
});
Route::get('/presentateur/dashboard', [SeminaireController::class, 'dashboardPresentateur'])->middleware('auth')->name('presentateur.dashboard');
Route::get('/seminaire/create', [SeminaireController::class, 'create'])->name('seminaire.create');

Route::post('/seminaire', [SeminaireController::class, 'store'])->name('seminaire.store');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/secretaire/dashboard', [SecretaireController::class, 'index'])->name('secretaire.dashboard');
    Route::post('/secretaire/valider/{id}', [SecretaireController::class, 'valider'])->name('secretaire.valider');
    Route::post('/secretaire/rejeter/{id}', [SecretaireController::class, 'rejeter'])->name('secretaire.rejeter');
});


require __DIR__.'/auth.php';
