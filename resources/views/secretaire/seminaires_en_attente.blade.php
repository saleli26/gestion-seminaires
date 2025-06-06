@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <!-- En-tête stylisé -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
        <div class="flex items-center mb-4 md:mb-0">
            <div class="relative">
                <div class="absolute -inset-3 bg-gradient-to-r from-amber-400 to-yellow-500 rounded-full opacity-20 blur-sm"></div>
                <div class="relative bg-gradient-to-r from-amber-400 to-yellow-500 p-3 rounded-full text-white">
                    <i class="fas fa-hourglass-half text-xl"></i>
                </div>
            </div>
            <div class="ml-4">
                <h1 class="text-3xl font-bold text-gray-800">Séminaires en attente</h1>
                <p class="text-gray-600 mt-1">Demandes nécessitant votre validation</p>
            </div>
        </div>
        <div class="bg-gradient-to-r from-amber-50 to-yellow-50 px-4 py-2 rounded-lg border border-amber-100 shadow-sm">
            <p class="text-sm text-amber-700 font-medium">
                <i class="fas fa-bell mr-1"></i>
                {{ $seminaires->where('statut', 'en attente')->count() }} demande(s) en attente
            </p>
        </div>
    </div>

    <!-- Card principale -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        @if($seminaires->where('statut', 'en attente')->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Thème</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Présentateur</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Résumé</th>
                        <th class="px-6 py-5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($seminaires as $seminaire)
                        @if($seminaire->statut == 'en attente')
                        <tr class="hover:bg-gray-50 transition-all duration-200 ease-out">
                            <!-- Colonne Thème -->
                            <td class="px-8 py-5 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-gradient-to-br from-amber-100 to-yellow-100 p-2 rounded-lg mr-4">
                                        <i class="fas fa-microphone-alt text-amber-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900">{{ $seminaire->theme }}</div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                <i class="fas fa-clock mr-1 text-xs"></i> En attente
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Colonne Présentateur -->
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="bg-gradient-to-br from-blue-100 to-indigo-100 h-10 w-10 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                            {{ substr($seminaire->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-semibold text-gray-900">{{ $seminaire->user->name }}</div>
                                        <div class="text-sm text-gray-500 truncate max-w-[150px]">{{ $seminaire->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Colonne Date -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if($seminaire->date)
                                    <div class="flex items-center">
                                        <div class="bg-gradient-to-br from-green-100 to-emerald-100 p-2 rounded-lg mr-3">
                                            <i class="fas fa-calendar-day text-emerald-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($seminaire->date)->isoFormat('ddd D MMM YYYY') }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($seminaire->date)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic">Non spécifiée</span>
                                @endif
                            </td>
                            
                            <!-- Colonne Résumé -->
                            <td class="px-6 py-5 max-w-xs">
                                @if($seminaire->resume)
                                    <div class="relative group">
                                        <div class="text-gray-700 line-clamp-2 max-w-xs pr-6">
                                            {{ $seminaire->resume }}
                                        </div>
                                        <div class="absolute right-0 top-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button class="text-gray-400 hover:text-gray-600" 
                                                @click="showResumeModal = true; currentResume = '{{ $seminaire->resume }}'">
                                                <i class="fas fa-expand-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic">Aucun résumé</span>
                                @endif
                            </td>
                            
                            <!-- Colonne Actions -->
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex flex-col space-y-3 min-w-[200px]">
                                    <form action="{{ route('secretaire.valider', $seminaire->id) }}" method="POST" class="flex">
                                        @csrf
                                        <div class="relative flex-grow mr-2">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <input type="date" name="date_presentation" 
                                                class="pl-10 border border-gray-300 rounded-lg px-4 py-2 text-sm w-full focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition"
                                                min="{{ now()->addDays(3)->format('Y-m-d') }}"
                                                required>
                                        </div>
                                        <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md hover:shadow-lg transition-all duration-200">
                                            <i class="fas fa-check mr-2"></i> Valider
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('secretaire.rejeter', $seminaire->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-2 rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-all duration-200">
                                            <i class="fas fa-times mr-2"></i> Rejeter
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <!-- État vide amélioré -->
        <div class="py-16 px-4 text-center">
            <div class="max-w-md mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-br from-green-50 to-emerald-100 mb-6">
                    <i class="fas fa-check-circle text-3xl text-emerald-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Tout est traité !</h3>
                <p class="text-gray-600 mb-6">
                    Aucune demande de séminaire n'est en attente. Vous êtes à jour.
                </p>
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 inline-block">
                    <p class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        Les nouvelles demandes apparaîtront ici automatiquement
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>

<!-- Modal pour le résumé complet -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden" id="resumeModal">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">Résumé complet</h3>
            <button class="text-gray-400 hover:text-gray-600" onclick="document.getElementById('resumeModal').classList.add('hidden')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-[70vh]">
            <p class="text-gray-700 whitespace-pre-line" id="fullResumeText"></p>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 text-right">
            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 font-medium transition" 
                    onclick="document.getElementById('resumeModal').classList.add('hidden')">
                Fermer
            </button>
        </div>
    </div>
</div>

<script>
    // Gestion du modal de résumé
    function showFullResume(resume) {
        document.getElementById('fullResumeText').innerText = resume;
        document.getElementById('resumeModal').classList.remove('hidden');
    }

    // Ajouter des écouteurs d'événements aux boutons d'expansion
    document.querySelectorAll('[data-resume]').forEach(button => {
        button.addEventListener('click', () => {
            showFullResume(button.getAttribute('data-resume'));
        });
    });
</script>

<style>
    tr {
        border-bottom: 1px solid #f3f4f6;
    }
    thead th {
        border-top: none;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection