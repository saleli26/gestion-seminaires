<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('images/bg-login.jpg') }}');">
        <div class="bg-white bg-opacity-80 backdrop-blur-sm p-8 rounded-xl shadow-xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Créer un compte</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nom</label>
                    <input id="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input id="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Rôle -->
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 font-medium mb-2">Rôle</label>
                    <select id="role" name="role" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="">-- Sélectionner un rôle --</option>
                        <option value="etudiant">Étudiant</option>
                        <option value="presentateur">Présentateur</option>
                    </select>
                    @error('role') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                    <input id="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="password" name="password" required autocomplete="new-password">
                    @error('password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Confirmation -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirmer le mot de passe</label>
                    <input id="password_confirmation" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="password" name="password_confirmation" required>
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-blue-600 hover:underline" href="{{ route('login') }}">
                        Déjà inscrit ?
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
