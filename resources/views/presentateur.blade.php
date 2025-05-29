@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow-md mt-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Mes Séminaires</h1>

    <div class="flex justify-end mb-6">
    <a href="{{ route('seminaires.create') }}" class="bg-blue-600 text-white px-5 py-3 rounded shadow hover:bg-blue-700 transition duration-200">
        + Proposer un nouveau séminaire
    </a>
</div>


    @if($seminaires->count())
    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">Thème</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Date de présentation</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seminaires as $seminaire)
            <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2">{{ $seminaire->theme }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $seminaire->date_presentation ?? 'Non définie' }}</td>
                <td class="border border-gray-300 px-4 py-2 capitalize">{{ $seminaire->statut }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Aucun séminaire proposé pour le moment.</p>
    @endif
</div>
@endsection
