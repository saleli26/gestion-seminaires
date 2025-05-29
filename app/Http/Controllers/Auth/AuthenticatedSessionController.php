<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (auth()->user()->role === 'presentateur') {
            return redirect()->route('presentateur.dashboard');
        } elseif (auth()->user()->role === 'etudiant') {
            return redirect()->route('etudiant.dashboard');
        } elseif (auth()->user()->role === 'secretariat') {
            return redirect()->route('secretariat.dashboard');
        } else {
            return redirect()->intended('/');
        }
    }

    return back()->withErrors([
        'email' => 'Les informations d\'identification ne correspondent pas.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
