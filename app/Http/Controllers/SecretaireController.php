<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seminaire;

class SecretaireController extends Controller
{
    public function index(Request $request)
{
    // 1) Construction de la requête de base (Eloquent Query Builder)
    $query = Seminaire::query();

    // 2) Filtrage par recherche (thème OU nom du présentateur)
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('theme', 'like', "%{$search}%")
              ->orWhereHas('presenter', function($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
        });
    }

    // 3) Tri dynamique si demandé (vérifier que la colonne est valide !)
    $sortBy    = $request->input('sort_by', 'theme');
    $direction = $request->input('direction', 'asc');
    $allowed = ['theme','date','statut','presenter']; // colonnes autorisées
    if (in_array($sortBy, $allowed)) {
        $query->orderBy($sortBy, $direction);
    }

    // 4) Pagination : on récupère les résultats paginés
    $perPage = 10; // nombre d'éléments par page
    $Seminaires = $query->paginate($perPage);

    // 5) Calcul des statistiques globales (indépendamment des filtres)
    $totalSeminaires     = Seminaire::count();
    $validatedSeminaires = Seminaire::where('statut', 'valide')->count();
    $pendingSeminaires   = Seminaire::where('statut', 'en attente')->count();

    // 6) Retour de la vue avec les données
    return view('secretaire.dashboard', [
        'seminaires'          => $Seminaires,
        'totalseminaires'     => $totalSeminaires,
        'validatedseminaires' => $validatedSeminaires,
        'pendingseminaires'   => $pendingSeminaires,
    ]);
}




    public function valider(Request $request, $id)
{
    $request->validate([
        'date_presentation' => 'required|date|after_or_equal:today',
        'heure_presentation' => 'required|date_format:H:i',
        'lieu_presentation' => 'required|string|max:255',
    ]);

    $seminaire = Seminaire::findOrFail($id);

    // Concatène date + heure au format 'Y-m-d H:i:00'
    $datetime = $request->date_presentation . ' ' . $request->heure_presentation . ':00';

    $seminaire->statut = 'validé';
    $seminaire->date = $request->date_presentation;
    $seminaire->lieu = $request->lieu_presentation;
    $seminaire->heure = $request->heure_presentation;
    $seminaire->save();
    // Mail::to($request->user()->email)
    //     ->send(new PresentationNotification($presentation));
    return redirect()->back()->with('success', 'Séminaire validé avec date, heure et lieu.');
}




    public function rejeter($id)
    {
        $seminaire = Seminaire::findOrFail($id);
        $seminaire->statut = 'rejeté';
        $seminaire->save();

        return redirect()->route('secretaire.dashboard')->with('error', 'Séminaire rejeté.');
    }
    public function formDate($id)
{
    $seminaire = Seminaire::findOrFail($id);
    return view('secretaire.fixer-date', compact('seminaire'));
}

public function fixerDate(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date|after_or_equal:today',
    ]);

    $seminaire = Seminaire::findOrFail($id);
    $seminaire->date = $request->date;
    $seminaire->save();

    return redirect()->route('secretaire.dashboard')->with('success', 'Date fixée avec succès.');
}

public function recherche(Request $request)
{
    $search = $request->input('search', '');

    $query = Seminaire::with('user')
        ->where('theme', 'like', "%$search%")
        ->orWhereHas('user', function($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        });

    $seminaires = $query->orderBy('date', 'asc')->get();

    // Retourne un JSON avec les résultats
    return response()->json($seminaires);
}

public function seminairesEnAttente()
{
    $seminaires = Seminaire::where('statut', 'en attente')->latest()->get();
    return view('secretaire.seminaires_en_attente', compact('seminaires'));
}



}
