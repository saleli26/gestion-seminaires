@extends('layouts.app')

@section('content')
    
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Secrétaire</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1d4ed8',
                        secondary: '#f0f7ff',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                    }
                }
            }
        }
    </script>
    <style>
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .smooth-transition {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-chalkboard-teacher mr-3 text-primary"></i>
                        Tableau de bord Secrétaire
                    </h1>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="search" 
                            placeholder="Rechercher thème ou présentateur..." 
                            class="pl-10 pr-4 py-2 w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                        />
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-lg mr-4">
                            <i class="fas fa-file-alt text-primary text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Séminaires total</p>
                            <p class="text-2xl font-bold">{{ $totalseminaires }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-success">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-lg mr-4">
                            <i class="fas fa-check-circle text-success text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Séminaires validés</p>
                            <p class="text-2xl font-bold">{{ $validatedseminaires }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-warning">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 rounded-lg mr-4">
                            <i class="fas fa-hourglass-half text-warning text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">En attente</p>
                            <p class="text-2xl font-bold">{{ $pendingseminaires }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 bg-gradient-to-r from-primary to-blue-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-white">
                            <i class="fas fa-table mr-2"></i>Liste des séminaires
                        </h2>
                        <div class="flex space-x-2">
                            <a class="px-3 py-1 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 smooth-transition" href="#">
                                <i class="fas fa-sync-alt mr-1"></i> Actualiser
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="group flex items-center">
                                        Thème
                                        
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="group flex items-center">
                                        Présentateur 
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="group flex items-center">
                                        Date
                                        {{-- <i class="fas fa-sort ml-2 text-gray-400 group-hover:text-primary"></i> --}}
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="group flex items-center">
                                        Heure 
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="group flex items-center">
                                        Lieu 
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Résumé
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="resultats" class="bg-white divide-y divide-gray-200">
                            @foreach($seminaires as $seminaire)
                            <tr class="hover:bg-secondary smooth-transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $seminaire->theme }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-10 h-10 mr-3 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-500"></i>
                                </div>
                                        <div>
                                            <div class="font-medium">{{ $seminaire->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $seminaire->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($seminaire->date)
                                        <div class="text-gray-900">{{ \Carbon\Carbon::parse($seminaire->date)->format('d M Y') }}</div>
                                    @else
                                        <div class="text-gray-500">-</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $seminaire->heure ? \Carbon\Carbon::parse($seminaire->heure)->format('H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $seminaire->lieu ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($seminaire->fichier)
                                        <a href="{{ asset('storage/' . $seminaire->fichier) }}" class="text-primary hover:text-blue-800 flex items-center smooth-transition">
                                            <i class="far fa-file-pdf mr-2 text-lg"></i>
                                            Voir le résumé
                                        </a>
                                    @else
                                        <span class="text-gray-500 italic flex items-center">
                                            <i class="far fa-file-excel mr-2"></i>
                                            Aucun résumé
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($seminaire->statut == 'en attente')
                                        <div class="flex flex-col gap-3">
                                            <form action="{{ route('secretaire.valider', $seminaire->id) }}" method="POST">
                                                @csrf
                                                <div class="flex items-center space-x-2">
                                                    <input 
                                                        type="date" 
                                                        name="date_presentation" 
                                                        class="border rounded px-2 py-1 text-sm w-36" 
                                                        required
                                                    >
                                                    <input 
                                                        type="time" 
                                                        name="heure_presentation" 
                                                        class="border rounded px-2 py-1 text-sm w-28" 
                                                        required
                                                    >
                                                    <input 
                                                        type="text" 
                                                        name="lieu_presentation" 
                                                        class="border rounded px-2 py-1 text-sm w-48" 
                                                        placeholder="Lieu" 
                                                        required
                                                    >
                                                    <button 
                                                        type="submit" 
                                                        class="bg-success hover:bg-green-700 text-white px-3 py-1 rounded shadow flex items-center smooth-transition"
                                                    >
                                                        <i class="fas fa-check mr-1"></i> Valider
                                                    </button>
                                                </div>
                                            </form>


                                            <form action="{{ route('secretaire.rejeter', $seminaire->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-danger hover:bg-red-700 text-white px-3 py-1 rounded shadow flex items-center justify-center smooth-transition w-full">
                                                    <i class="fas fa-times mr-1"></i> Rejeter
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($seminaire->statut == 'validé')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 flex items-center w-fit">
                                            <i class="fas fa-check-circle mr-1"></i> Validé
                                        </span>
                                    @elseif($seminaire->statut == 'rejeté')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 flex items-center w-fit">
                                            <i class="fas fa-times-circle mr-1"></i> Rejeté
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-700">
                            Affichage de <span class="font-medium">{{ $seminaires->firstItem() }}</span> à <span class="font-medium">{{ $seminaires->lastItem() }}</span> sur <span class="font-medium">{{ $seminaires->total() }}</span> séminaires
                        </div>
                        <div class="flex space-x-2">
                            @if ($seminaires->onFirstPage())
                                <button disabled class="px-3 py-1 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            @else
                                <a href="{{ $seminaires->previousPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 smooth-transition">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            @foreach ($seminaires->getUrlRange(1, $seminaires->lastPage()) as $page => $url)
                                @if ($page == $seminaires->currentPage())
                                    <span class="px-3 py-1 bg-primary text-white rounded-lg">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 smooth-transition">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($seminaires->hasMorePages())
                                <a href="{{ $seminaires->nextPageUrl() }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 smooth-transition">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <button disabled class="px-3 py-1 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t mt-12">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="text-center text-sm text-gray-500">
                    <p>© 2025 Tableau de bord Secrétaire - Système de gestion des séminaires</p>
                    <p class="mt-1">Dernière mise à jour: {{ now()->format('d/m/Y à H:i') }}</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Loading Overlay -->
    <div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 text-center">
            <div class="animate-pulse text-primary text-5xl mb-4">
                <i class="fas fa-circle-notch fa-spin"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-800">Recherche en cours</h3>
            <p class="text-gray-600 mt-2">Veuillez patienter pendant que nous recherchons vos séminaires...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const loadingOverlay = document.getElementById('loading');
            
            searchInput.addEventListener('input', function () {
                const query = this.value.trim();
                
                if (query.length > 1) {
                    loadingOverlay.classList.remove('hidden');
                    
                    fetch(`/seminaires/search?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            updateTable(data);
                            loadingOverlay.classList.add('hidden');
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            loadingOverlay.classList.add('hidden');
                        });
                }
            });

            function updateTable(seminaires) {
                const tbody = document.getElementById('resultats');
                tbody.innerHTML = '';

                seminaires.forEach(seminaire => {
                    const row = document.createElement('tr');
                    row.className = 'hover:bg-secondary smooth-transition';
                    row.innerHTML = `
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">${seminaire.theme}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8 mr-3"></div>
                                <div>
                                    <div class="font-medium">${seminaire.user.name}</div>
                                    <div class="text-sm text-gray-500">${seminaire.user.email}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${seminaire.date ? 
                                `<div class="text-gray-900">${new Date(seminaire.date).toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' })}</div>` : 
                                `<div class="text-gray-500">-</div>`}
                        </td>
                        <td class="px-6 py-4">
                            ${seminaire.fichier ? 
                                `<a href="/storage/${seminaire.fichier}" class="text-primary hover:text-blue-800 flex items-center smooth-transition">
                                    <i class="far fa-file-pdf mr-2 text-lg"></i>
                                    Voir le résumé
                                </a>` : 
                                `<span class="text-gray-500 italic flex items-center">
                                    <i class="far fa-file-excel mr-2"></i>
                                    Aucun résumé
                                </span>`}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${seminaire.statut === 'en attente' ? 
                                `<div class="flex flex-col gap-3">
                                    <form action="/seminaires/${seminaire.id}/valider" method="POST">
                                        @csrf
                                        <div class="flex items-center">
                                            <input type="date" name="date_presentation" class="border rounded px-2 py-1 text-sm w-36 mr-2" required>
                                            <button type="submit" class="bg-success hover:bg-green-700 text-white px-3 py-1 rounded shadow flex items-center smooth-transition">
                                                <i class="fas fa-check mr-1"></i> Valider
                                            </button>
                                        </div>
                                    </form>
                                    <form action="/seminaires/${seminaire.id}/reject" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-danger hover:bg-red-700 text-white px-3 py-1 rounded shadow flex items-center justify-center smooth-transition w-full">
                                            <i class="fas fa-times mr-1"></i> Rejeter
                                        </button>
                                    </form>
                                </div>` : 
                                seminaire.statut === 'validé' ? 
                                    `<span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 flex items-center w-fit">
                                        <i class="fas fa-check-circle mr-1"></i> Validé
                                    </span>` : 
                                    `<span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 flex items-center w-fit">
                                        <i class="fas fa-times-circle mr-1"></i> Rejeté
                                    </span>`}
                        </td>
                    `;
                    tbody.appendChild(row);
                });
            }
        });
    </script>
</body>
</html>
@endsection