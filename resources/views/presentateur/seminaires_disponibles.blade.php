@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Séminaires disponibles</h1>

    @if ($seminaires->isEmpty())
        <p class="text-gray-600">Aucun séminaire validé pour le moment.</p>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="py-3 px-6 text-left">Thème</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Résumé</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach ($seminaires as $seminaire)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $seminaire->theme }}</td>
                            <td class="py-3 px-6">
                                {{ \Carbon\Carbon::parse($seminaire->date)->format('d/m/Y') }}
                            </td>
                            <td class="py-3 px-6">
                                {{ $seminaire->resume ?? 'Aucun résumé' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
