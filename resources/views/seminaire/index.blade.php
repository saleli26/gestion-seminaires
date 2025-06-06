
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h2 class="text-xl font-bold mb-4">Liste des séminaires disponibles</h2>

    <input type="text" id="search" placeholder="Rechercher un séminaire..."
        class="border rounded px-3 py-2 w-full mb-4" />

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Thème</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Présentateur</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Résumé</th>
                </tr>
            </thead>
            <tbody class="text-gray-700" id="resultats">
                @foreach ($seminaires as $seminaire)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $seminaire->theme }}</td>
                        <td class="px-6 py-4">{{ $seminaire->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $seminaire->date }}</td>
                        <td class="px-6 py-4">
                            @if($seminaire->resume)
                                {{ $seminaire->resume }}
                            @else
                                <em class="text-gray-500">Aucun résumé</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                    resultBody.innerHTML = `<tr><td colspan="4" class="px-6 py-4 text-center">Aucun résultat</td></tr>`;
                    return;
                }

                data.forEach(seminaire => {
                    const date = seminaire.date ?? 'À venir';
                    const resume = seminaire.resume ?? '<em class="text-gray-500">Aucun résumé</em>';
                    const userName = seminaire.user ? seminaire.user.name : 'N/A';

                    const row = `
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-6 py-4">${seminaire.theme}</td>
                            <td class="px-6 py-4">${userName}</td>
                            <td class="px-6 py-4">${date}</td>
                            <td class="px-6 py-4">${resume}</td>
                        </tr>
                    `;
                    resultBody.insertAdjacentHTML('beforeend', row);
                });
            });
    });
});
</script>
@endsection
