<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminaireController;
use App\Http\Controllers\SecretaireController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard de base (ne sera plus utilisé car redirection par rôle)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authentification & profil utilisateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes étudiant
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/etudiant/dashboard', function () {
        return redirect()->route('etudiants.seminaires');
    })->name('etudiant.dashboard');

    Route::get('/etudiants/seminaires', [EtudiantController::class, 'index'])->name('etudiants.seminaires');
    Route::get('/etudiants/seminaires/recherche', [EtudiantController::class, 'recherche'])->name('etudiants.seminaires.recherche');
    // Route pour la page principale
Route::get('/seminaires', [SeminaireController::class, 'index'])
    ->name('seminaires.index');

// Route pour la recherche AJAX
Route::get('/seminaires/recherche', [SeminaireController::class, 'recherche'])
    ->name('etudiants.seminaires.recherche');
});

/*
|--------------------------------------------------------------------------
| Routes secrétaire
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/secretaire/dashboard', [SecretaireController::class, 'index'])->name('secretaire.dashboard');
    Route::post('/secretaire/valider/{id}', [SecretaireController::class, 'valider'])->name('secretaire.valider');
    Route::post('/secretaire/rejeter/{id}', [SecretaireController::class, 'rejeter'])->name('secretaire.rejeter');
    Route::get('/secretaire/seminaires/recherche', [SecretaireController::class, 'recherche'])->name('secretaire.seminaires.recherche');
    Route::get('/secretaire/seminaires/en-attente', [SecretaireController::class, 'seminairesEnAttente'])->name('secretaire.seminaires.attente');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');


});

/*
|--------------------------------------------------------------------------
| Routes présentateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/presentateur/dashboard', [SeminaireController::class, 'dashboardPresentateur'])->name('presentateur.dashboard');
    Route::get('/seminaire/create', [SeminaireController::class, 'create'])->name('seminaire.create');
    Route::post('/seminaire', [SeminaireController::class, 'store'])->name('seminaire.store');
    Route::post('/seminaire/{id}/envoyer-resume', [SeminaireController::class, 'envoyerResume'])->name('seminaire.envoyer_resume');
    Route::get('/presentateur/seminaires/disponibles', [SeminaireController::class, 'seminairesDisponibles'])->name('presentateur.seminaires.disponibles');
    Route::post('/seminaires/{id}/upload-resume', [App\Http\Controllers\SeminaireController::class, 'uploadResume'])
    ->name('seminaire.upload_resume');
    Route::post('/seminaire/upload/{id}', [SeminaireController::class, 'upload'])
     ->name('seminaire.upload');

});


/*
|--------------------------------------------------------------------------
| Routes génériques séminaires (si besoin CRUD global)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('seminaires', SeminaireController::class);
});

/*
|--------------------------------------------------------------------------
| Routes d'authentification (Laravel Breeze / Fortify / Jetstream etc.)
|--------------------------------------------------------------------------
*/


require __DIR__.'/auth.php';
