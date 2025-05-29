<div class="overflow-x-auto mt-8">
    <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="text-left px-6 py-3 text-sm font-semibold uppercase">Thème</th>
                <th class="text-left px-6 py-3 text-sm font-semibold uppercase">Présentateur</th>
                <th class="text-left px-6 py-3 text-sm font-semibold uppercase">Date</th>
                <th class="text-left px-6 py-3 text-sm font-semibold uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach ($seminaires as $seminaire)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $seminaire->theme }}</td>
                    <td class="px-6 py-4">{{ $seminaire->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $seminaire->date }}</td>
                    <td class="px-6 py-4">
                        @if ($seminaire->statut == 'en attente')
                            <div class="flex gap-2">
                                <form action="{{ route('secretaire.valider', $seminaire->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded shadow">
                                        Valider
                                    </button>
                                </form>

                                <form action="{{ route('secretaire.rejeter', $seminaire->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">
                                        Rejeter
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $seminaire->statut == 'validé' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($seminaire->statut) }}
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
