<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plateforme Séminaires - IMSP</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Animation (AOS) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-100 to-white min-h-screen flex flex-col items-center justify-center text-gray-800">

    <!-- Logo -->
    <div class="mb-6" data-aos="fade-down">
        <img src="{{ asset('images/uac-logo.png') }}" alt="Logo UAC" class="h-24 mx-auto">
    </div>

    <!-- Titre animé -->
    <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-4" data-aos="zoom-in">
        Bienvenue sur la plateforme de gestion des séminaires
    </h1>

    <p class="text-lg text-center mb-8 max-w-xl" data-aos="fade-up">
        Une plateforme intuitive pour soumettre, valider et consulter les séminaires de l’IMSP.
    </p>

    <!-- Boutons -->
    <div class="flex gap-6" data-aos="fade-up" data-aos-delay="200">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-lg transition">
                    Accéder au Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-lg transition">
                    Connexion
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium rounded-lg shadow-lg transition">
                        Inscription
                    </a>
                @endif
            @endauth
        @endif
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 text-sm text-gray-500" data-aos="fade-in" data-aos-delay="500">
        © {{ date('Y') }} Université d’Abomey-Calavi - IMSP
    </footer>

    <!-- AOS Animation script -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
