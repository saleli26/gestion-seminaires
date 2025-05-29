@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Tableau de bord - Secrétaire Scientifique</h2>

    @if (session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-200 text-red-800 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow-md">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-3 px-6 text-left">Présentateur</th>
                    <th class="py-3 px-6 text-left">Thème</th>
                    <th class="py-3 px-6 text-left">Date</th>
                    <th class="py-3 px-6 text-left">Statut</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seminaires as $seminaire)
                    <tr class="border-b">
                        <td class="py-3 px-6">{{ $seminaire->user->name ?? 'Inconnu' }}</td>
                        <td class="py-3 px-6">{{ $seminaire->theme }}</td>
                        <td class="py-3 px-6">{{ $seminaire->date }}</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-1 rounded text-sm 
                                @if($seminaire->statut == 'validé') bg-green-200 text-green-800
                                @elseif($seminaire->statut == 'rejeté') bg-red-200 text-red-800
                                @else bg-yellow-200 text-yellow-800 @endif">
                                {{ ucfirst($seminaire->statut ?? 'en attente') }}
                            </span>
                        </td>
                        <td class="py-3 px-6">
                            @if(!$seminaire->statut)
                                <form action="{{ route('secretaire.valider', $seminaire->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Valider</button>
                                </form>
                                <form action="{{ route('secretaire.rejeter', $seminaire->id) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Rejeter</button>
                                </form>
                            @else
                                <span class="text-gray-500 italic">Traitée</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
