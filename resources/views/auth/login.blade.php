<x-guest-layout>
    <div class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('{{ asset('images/bg-login.jpg') }}');">
        <div class="bg-white bg-opacity-80 backdrop-blur-sm p-8 rounded-xl shadow-xl max-w-md w-full">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h2>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input id="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300" type="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <!-- Password avec l'œil -->
                <div class="mb-6 relative">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                    <input id="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-blue-300 pr-10" type="password" name="password" required>

                    <!-- Icône œil -->
                    <span onclick="togglePassword()" class="absolute right-3 top-10 cursor-pointer text-gray-600 hover:text-gray-900">
                        👁️
                    </span>
                </div>

                <!-- Remember Me -->
                <div class="block mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                </div>

                <div class="flex justify-between items-center">
                    <a class="underline text-sm text-blue-600 hover:text-blue-900" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JS pour toggle mot de passe -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>
