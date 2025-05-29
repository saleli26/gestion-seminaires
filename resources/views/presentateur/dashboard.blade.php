@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Tableau de bord Présentateur</h1>

    <div class="mb-6">
        <a href="{{ route('seminaire.create') }}"
           class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            ➕ Demander un séminaire
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
    <tr>
        <th class="py-3 px-6 text-left">Thème</th>
        <th class="py-3 px-6 text-left">Date</th>
        <th class="py-3 px-6 text-left">Statut</th>
    </tr>
</thead>
<tbody class="text-gray-800">
    @forelse ($seminaires as $seminaire)
        <tr class="border-t hover:bg-gray-50">
            <td class="py-3 px-6">{{ $seminaire->theme }}</td>
            <td class="py-3 px-6">{{ \Carbon\Carbon::parse($seminaire->date)->format('d/m/Y') }}</td>
            <td class="py-3 px-6">
                @if($seminaire->statut === 'validé')
                    <span class="text-green-600 font-semibold">Validé</span>
                @elseif($seminaire->statut === 'rejeté')
                    <span class="text-red-600 font-semibold">Rejeté</span>
                @else
                    <span class="text-yellow-500 font-semibold">En attente</span>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="py-4 px-6 text-center text-gray-500">Aucun séminaire demandé pour l’instant.</td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>
</div>
@endsection
