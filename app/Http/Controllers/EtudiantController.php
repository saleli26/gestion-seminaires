<?php

namespace App\Http\Controllers;
use App\Models\Seminaire;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
{
    // Récupérer tous les séminaires validés, triés par date croissante
    $seminaires = Seminaire::where('statut', 'validé')
                ->orderBy('date', 'asc')
                ->paginate(10); // 10 séminaires par page

    // Nombre de séminaires dont la date est dans le futur (par rapport à aujourd'hui)
    $upcomingSeminars = Seminaire::whereDate('date', '>', now())->count();

    // Nombre d'intervenants distincts (utilisateurs liés aux séminaires validés)
    $speakersCount = Seminaire::where('statut', 'validé')
                    ->distinct('user_id')
                    ->count('user_id');

    // Nombre de thèmes distincts parmi les séminaires validés
    $themesCount = Seminaire::where('statut', 'validé')
                    ->distinct('theme')
                    ->count('theme');

    return view('etudiants.index', compact(
        'seminaires',
        'upcomingSeminars',
        'speakersCount',
        'themesCount'
    ));
}


    public function recherche(Request $request)
    {
        $search = $request->input('search', '');

        $query = Seminaire::with('user')
            ->where('statut', 'validé')
            ->where(function ($q) use ($search) {
                $q->where('theme', 'like', "%$search%")
                ->orWhereHas('user', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                });
            });

        $seminaires = $query->orderBy('date', 'asc')->get();

        return response()->json($seminaires);
    }

}
