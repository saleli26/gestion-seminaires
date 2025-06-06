<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('images/bg-login.jpg') }}');">
        <div class="bg-white bg-opacity-80 backdrop-blur-sm p-8 rounded-xl shadow-xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Mot de passe oublié</h2>

            <div class="mb-4 text-sm text-gray-600">
                Vous avez oublié votre mot de passe ? Aucun souci. Indiquez votre adresse email et nous vous enverrons un lien de reinitialisation.
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input id="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                        Retour à la connexion
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Envoyer le lien
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
