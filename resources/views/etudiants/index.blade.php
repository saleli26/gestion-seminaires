@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- En-tête avec illustration -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Séminaires Universitaires</h1>
            <p class="text-gray-600 max-w-2xl">
                Découvrez les prochains séminaires et conférences organisés par notre université.
                Inscrivez-vous pour ne rien manquer!
            </p>
        </div>
        <div class="bg-blue-100 rounded-xl p-5 flex items-center justify-center">
            <i class="fas fa-chalkboard-teacher text-5xl text-blue-600"></i>
        </div>
    </div>
    <style>
    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .seminar-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .seminar-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .search-container {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }
    
    .header-gradient {
        background: linear-gradient(90deg, #1e40af 0%, #3b82f6 100%);
    }
    
    .pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
        100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
    }
    
    .date-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
    }
    
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }
</style>
    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-md flex items-center">
            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                <i class="fas fa-calendar-day text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Séminaires à venir</p>
                <p class="text-2xl font-bold text-gray-800">{{ $upcomingSeminars }}</p>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-5 shadow-md flex items-center">
            <div class="bg-orange-100 p-3 rounded-lg mr-4">
                <i class="fas fa-users text-orange-500 text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Intervenants</p>
                <p class="text-2xl font-bold text-gray-800">{{ $speakersCount }}</p>
            </div>
        </div>
        
        <div class="bg-white rounded-xl p-5 shadow-md flex items-center">
            <div class="bg-green-100 p-3 rounded-lg mr-4">
                <i class="fas fa-book-open text-green-500 text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Thèmes abordés</p>
                <p class="text-2xl font-bold text-gray-800">{{ $themesCount }}</p>
            </div>
        </div>
    </div>
    
    <!-- Barre de recherche -->
    <div class="search-container mb-8">
        <div class="relative">
            <div class="search-icon">
                <i class="fas fa-search"></i>
            </div>
            <input 
                type="text" 
                id="search" 
                placeholder="Rechercher un séminaire par thème, présentateur ou résumé..." 
                class="w-full pl-12 pr-5 py-4 rounded-xl border-0 shadow-lg focus:ring-2 focus:ring-blue-500 focus:outline-none text-gray-700"
            >
        </div>
    </div>
    
    <!-- En-tête de liste -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">
            <i class="fas fa-list mr-2 text-blue-500"></i>
            Liste des séminaires disponibles
        </h2>
        
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-600">Trier par :</span>
            <select class="bg-white px-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Date récente</option>
                <option>Date ancienne</option>
                <option>Ordre alphabétique</option>
            </select>
        </div>
    </div>
    
    <!-- Liste des séminaires -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="header-gradient px-6 py-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 text-white font-semibold">
                <div class="md:col-span-3 flex items-center">
                    <i class="fas fa-bookmark mr-2"></i> Thème
                </div>
                <div class="md:col-span-2 flex items-center">
                    <i class="fas fa-user mr-2"></i> Présentateur
                </div>
                <div class="md:col-span-2 flex items-center">
                    <i class="fas fa-calendar mr-2"></i> Date
                </div>
                <div class="md:col-span-3 flex items-center">
                    <i class="fas fa-file-alt mr-2"></i> Résumé
                </div>
                <div class="md:col-span-2 flex items-center">
                    <i class="fas fa-file-pdf mr-2"></i> Fichier
                </div>
            </div>
        </div>
        
        <div id="resultats" class="divide-y divide-gray-100">
            @forelse ($seminaires as $seminaire)
                <div class="seminar-card px-6 py-5 hover:bg-blue-50 cursor-pointer">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <!-- Thème -->
                        <div class="md:col-span-3">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                    <i class="fas fa-microphone text-blue-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-800">{{ $seminaire->theme }}</h3>
                            </div>
                        </div>
                        
                        <!-- Présentateur -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10 mr-3 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                <span class="text-gray-700">{{ $seminaire->user->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                        
                        <!-- Date -->
                        <div class="md:col-span-2">
                            <div class="flex items-center">
                                @if($seminaire->date)
                                    <span class="date-badge px-3 py-1 rounded-full text-white text-sm font-medium">
                                        {{ \Carbon\Carbon::parse($seminaire->date)->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="bg-gray-200 px-3 py-1 rounded-full text-gray-700 text-sm">
                                        À venir
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Résumé -->
                        <div class="md:col-span-3">
                            @if($seminaire->resume)
                                <p class="text-gray-600 text-sm line-clamp-2">
                                    {{ $seminaire->resume }}
                                </p>
                            @else
                                <p class="text-gray-400 italic text-sm">
                                    <i class="fas fa-info-circle mr-1"></i> Aucun résumé disponible
                                </p>
                            @endif
                        </div>
                        
                        <!-- Fichier et État -->
                        <div class="md:col-span-2">
                            @if($seminaire->fichier)
                                <a href="{{ asset('storage/'.$seminaire->fichier) }}" target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-file-pdf mr-2"></i> Télécharger
                                </a>
                            @else
                                <span class="text-gray-500 text-sm">Aucun fichier</span>
                            @endif
                            
                            <!-- Badge d'état -->
                            <div class="mt-2">
                                @if($seminaire->statut === 'validé')
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Validé
                                    </span>
                                @elseif($seminaire->statut === 'en_attente')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i> Refusé
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 px-4">
                    <div class="mx-auto bg-gray-200 border-2 border-dashed rounded-full w-16 h-16 mb-4 flex items-center justify-center">
                        <i class="fas fa-microphone-slash text-gray-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun séminaire disponible</h3>
                    <p class="text-gray-600 max-w-md mx-auto">
                        Aucun séminaire n'a été programmé pour le moment. Veuillez vérifier ultérieurement.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
    
    <!-- Pagination -->
    @if($seminaires->hasPages())
        <div class="mt-6">
            {{ $seminaires->links() }}
        </div>
    @endif
    
    <!-- Call to action -->
    <div class="mt-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl p-8 text-center text-white pulse">
        <h3 class="text-2xl font-bold mb-3">Vous souhaitez organiser un séminaire?</h3>
        <p class="mb-5 max-w-2xl mx-auto">Rejoignez notre communauté d'intervenants et partagez vos connaissances avec nos étudiants et chercheurs.</p>
        <a href="{{ route('seminaires.create') }}" class="bg-white text-blue-600 font-bold py-3 px-8 rounded-full hover:bg-gray-100 transition duration-300 inline-block">
            Proposer un séminaire
        </a>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const resultBody = document.getElementById('resultats');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        fetch(`{{ route('etudiants.seminaires.recherche') }}?search=` + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                resultBody.innerHTML = '';

                if (data.length === 0) {
                    resultBody.innerHTML = `
                        <div class="empty-state text-center py-16 px-4 rounded-xl">
                            <div class="mx-auto bg-gray-200 border-2 border-dashed rounded-full w-16 h-16 mb-4 flex items-center justify-center">
                                <i class="fas fa-search text-gray-500 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun séminaire trouvé</h3>
                            <p class="text-gray-600 max-w-md mx-auto">
                                Aucun séminaire ne correspond à votre recherche. Essayez d'autres termes.
                            </p>
                        </div>
                    `;
                    return;
                }

                data.forEach(seminaire => {
                    const date = seminaire.date ? 
                        `<span class="date-badge px-3 py-1 rounded-full text-white text-sm font-medium">
                            ${new Date(seminaire.date).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}
                        </span>` : 
                        `<span class="bg-gray-200 px-3 py-1 rounded-full text-gray-700 text-sm">À venir</span>`;
                    
                    const resume = seminaire.resume ? 
                        `<p class="text-gray-600 text-sm line-clamp-2">${seminaire.resume}</p>` : 
                        `<p class="text-gray-400 italic text-sm"><i class="fas fa-info-circle mr-1"></i> Aucun résumé disponible</p>`;
                    
                    const userName = seminaire.user ? seminaire.user.name : 'N/A';
                    
                    // État badge
                    let stateBadge = '';
                    if (seminaire.statut === 'validé') {
                        stateBadge = `<span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Validé
                                     </span>`;
                    } else if (seminaire.statut === 'en_attente') {
                        stateBadge = `<span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                     </span>`;
                    } else {
                        stateBadge = `<span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i> Refusé
                                     </span>`;
                    }
                    
                    // Fichier PDF
                    const fichier = seminaire.fichier ? 
                        `<a href="{{ asset('storage') }}/${seminaire.fichier}" target="_blank" 
                           class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <i class="fas fa-file-pdf mr-2"></i> Télécharger
                         </a>` : 
                        `<span class="text-gray-500 text-sm">Aucun fichier</span>`;
                    
                    const row = `
                        <div class="seminar-card px-6 py-5 hover:bg-blue-50 cursor-pointer">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                                <div class="md:col-span-3">
                                    <div class="flex items-center">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                            <i class="fas fa-microphone text-blue-600"></i>
                                        </div>
                                        <h3 class="font-semibold text-gray-800">${seminaire.theme}</h3>
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="flex items-center">
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10 mr-3 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500"></i>
                                        </div>
                                        <span class="text-gray-700">${userName}</span>
                                    </div>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <div class="flex items-center">
                                        ${date}
                                    </div>
                                </div>
                                
                                <div class="md:col-span-3">
                                    ${resume}
                                </div>
                                
                                <div class="md:col-span-2">
                                    ${fichier}
                                    <div class="mt-2">
                                        ${stateBadge}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    resultBody.insertAdjacentHTML('beforeend', row);
                });
            });
    });
});
</script>
@endsection