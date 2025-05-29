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
    $seminaires = auth()->user()->seminaires()->latest()->get();
    return view('seminaires.index', compact('seminaires'));
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
    ]);

    $request->user()->seminaires()->create([
        'theme' => $request->theme,
    ]);

    return redirect()->route('seminaires.index')->with('success', 'Demande envoyée avec succès !');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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


}
