@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Demander un nouveau séminaire</h1>

    <form method="POST" action="{{ route('seminaire.store') }}">
        @csrf

        <label class="block mb-2" for="theme">Thème du séminaire</label>
        <input id="theme" name="theme" type="text" class="w-full border border-gray-300 p-2 rounded mb-4" required>

        <label class="block mb-2" for="date">Date prévue</label>
        <input id="date" name="date" type="date" class="w-full border border-gray-300 p-2 rounded mb-4" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer la demande</button>
    </form>
</div>
@endsection
