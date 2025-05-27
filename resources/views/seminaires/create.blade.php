@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Faire une demande de séminaire</h2>

    <form action="{{ route('seminaires.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="theme" class="block font-medium">Thème :</label>
            <input type="text" name="theme" id="theme" class="w-full border border-gray-300 p-2 rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Envoyer la demande</button>
    </form>
</div>
@endsection
