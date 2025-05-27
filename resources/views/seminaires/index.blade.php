@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Mes demandes de séminaire</h2>

    @foreach($seminaires as $s)
        <div class="border-b py-3">
            <p><strong>Thème :</strong> {{ $s->theme }}</p>
            <p><strong>État :</strong> {{ $s->etat }}</p>
            <p><strong>Date prévue :</strong> {{ $s->date ?? 'Pas encore fixée' }}</p>
        </div>
    @endforeach
</div>
@endsection
