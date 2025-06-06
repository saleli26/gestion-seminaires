@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-2xl font-semibold mb-4">Fixer la date pour le séminaire : "{{ $seminaire->theme }}"</h1>

    <form method="POST" action="{{ route('secretaire.fixerDate', $seminaire->id) }}" class="bg-white p-6 rounded shadow">
        @csrf
        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Date de présentation</label>
            <input type="date" id="date" name="date" value="{{ old('date', $seminaire->date) }}"
                   class="mt-1 block w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mt-6">
            <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
        </div>
    </form>
</div>
@endsection
