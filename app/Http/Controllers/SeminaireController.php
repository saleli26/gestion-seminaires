<?php

namespace App\Http\Controllers;
use App\Models\Seminaire;

use Illuminate\Http\Request;

class SeminaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
    {
        // Récupérer les séminaires validés avec pagination
        $seminaires = Seminaire::with('user')
            ->where('statut', 'validé')
            ->orderBy('date', 'desc')
            ->paginate(10);
        
        // Calculer les statistiques
        $upcomingSeminars = Seminaire::where('date', '>=', Carbon::today())
            ->where('statut', 'validé')
            ->count();
        
        $speakersCount = User::whereHas('seminaires', function($query) {
                $query->where('statut', 'validé');
            })
            ->distinct()
            ->count('id');
        
        $themesCount = Seminaire::where('statut', 'validé')
            ->distinct('theme')
            ->count('theme');
        
        return view('seminaires.index', compact(
            'seminaires',
            'upcomingSeminars',
            'speakersCount',
            'themesCount'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    // app/Http/Controllers/SeminaireController.php

public function create()
{
    return view('seminaire.create');
}

public function store(Request $request)
{
    $request->validate([
        'theme' => 'required|string|max:255',
        'resume' => 'string|max:300'
    ]);

    $request->user()->seminaires()->create([
        'theme' => $request->theme,
        'resume'=> $request->resume
    ]);

    return redirect()->route('presentateur.dashboard')->with('success', 'Demande envoyée avec succès !');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function dashboardPresentateur()
{
    $seminaires = Seminaire::where('user_id', auth()->id())->get();

    return view('presentateur.dashboard', compact('seminaires'));
}

public function seminairesDisponibles()
{
    $seminaires = Seminaire::where('statut', 'validé')->orderBy('date', 'asc')->get();

    return view('presentateur.seminaires_disponibles', compact('seminaires'));
}
public function upload(Request $request, $id)
{
    $request->validate([
        'fichier' => 'required|mimes:pdf|max:2048'
    ]);

    $seminaire = Seminaire::findOrFail($id);
    
    if ($request->hasFile('fichier')) {
        // Supprime l'ancien fichier
        if ($seminaire->fichier) {
            Storage::delete('public/' . $seminaire->fichier);
        }
        
        // Stocke dans public/seminaires
        $path = $request->file('fichier')->store('seminaires', 'public');
        $seminaire->fichier = $path;
        $seminaire->save();
    }

    return back()->with('success', 'Résumé téléchargé avec succès!');
}

public function recherche(Request $request)
    {
        $search = $request->input('search');
        
        $seminaires = Seminaire::with('user')
            ->where('statut', 'validé')
            ->where(function($query) use ($search) {
                $query->where('theme', 'like', "%$search%")
                    ->orWhere('resume', 'like', "%$search%")
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->get();
        
        return response()->json($seminaires);
    }
}
