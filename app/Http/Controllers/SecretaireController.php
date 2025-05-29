<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seminaire;
class SecretaireController extends Controller
{
    public function index()
    {
        $seminaires = Seminaire::orderBy('created_at', 'desc')->get();
        return view('secretaire.dashboard', compact('seminaires'));
    }
    public function valider($id)
    {
        $seminaire = Seminaire::findOrFail($id);
        $seminaire->statut = 'validé';
        $seminaire->save();

        return redirect()->route('secretaire.dashboard')->with('success', 'Séminaire validé.');
    }

    public function rejeter($id)
    {
        $seminaire = Seminaire::findOrFail($id);
        $seminaire->statut = 'rejeté';
        $seminaire->save();

        return redirect()->route('secretaire.dashboard')->with('error', 'Séminaire rejeté.');
    }


}
