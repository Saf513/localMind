<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Questions Locales - Landing Page</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styles personnalisés pour les animations, polices, etc. (voir section CSS plus bas) */
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo et Nom -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <span class="text-2xl font-bold text-emerald-600">Qwesta</span>
                    </a>
                </div>
    
                <!-- Navigation principale -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('questions') }}" class="text-gray-600 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                        Questions
                    </a>
                    
                    @auth
                        <a href="" class="text-gray-600 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                            Mon Profil
                        </a>
                        <form method="GET" action="/logout" class="inline">
                            @csrf
                            <button type="submit" class="bg-emerald-500 text-white px-4 py-2 rounded-full hover:bg-emerald-600 transition duration-300">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="text-gray-600 hover:text-emerald-600 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                            S'inscrire
                        </a>
                        <a href="{{ route('login') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-full hover:bg-emerald-600 transition duration-300">
                            Connexion
                        </a>
                    @endauth
                </div>
    
                <!-- Menu mobile -->
                <div class="md:hidden flex items-center">
                    <button class="mobile-menu-button p-2 rounded-md hover:bg-gray-100 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    
        <!-- Menu mobile (caché par défaut) -->
        <div class="md:hidden hidden mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('questions') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50">
                    Questions
                </a>
                
                @auth
                    <a href="" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50">
                        Mon Profil
                    </a>
                    <form method="GET" action="/logout" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50">
                        S'inscrire
                    </a>
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-emerald-600 hover:bg-gray-50">
                        Connexion
                    </a>
                @endauth
            </div>
        </div>
    </nav>
    
    <!-- Ajoutez ce script pour le menu mobile -->
    <script>
        const btn = document.querySelector('.mobile-menu-button');
        const menu = document.querySelector('.mobile-menu');
    
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    <!-- Section Héroïque -->
    <header class="relative py-24 bg-cover bg-center" style="background-image: url('images/hero-bg.jpg')">
        
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="container mx-auto text-center relative z-10">
            <h1 class="text-5xl font-bold text-white leading-tight mb-4">
                Découvrez les questions locales.<br>
                Explorez, connectez, apprenez.
            </h1>
            <p class="text-xl text-gray-200 mb-8">
                La plateforme qui vous connecte aux connaissances de votre communauté.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="inline-block bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    Essayer gratuitement
                </a>
                <a href="#features" class="inline-block text-white hover:text-gray-300 font-semibold py-3 px-6 rounded-full border border-white transition duration-300">
                    En savoir plus
                </a>
            </div>
        </div>
    </header>

    <!-- Section "Pourquoi [Plateforme]?" -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Pourquoi choisir Qwesta ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <i class="fas fa-map-marker-alt fa-3x text-emerald-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Pertinence Locale</h3>
                    <p class="text-gray-600">Trouvez des réponses à vos questions dans votre quartier.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <i class="fas fa-users fa-3x text-emerald-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Communauté Active</h3>
                    <p class="text-gray-600">Connectez-vous avec des experts et des passionnés.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <i class="fas fa-check-circle fa-3x text-emerald-500 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Informations Fiables</h3>
                    <p class="text-gray-600">Des réponses vérifiées par des utilisateurs de confiance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section "Fonctionnalités Clés" -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Fonctionnalités qui vous connectent au monde local</h2>

            <!-- Carousel de fonctionnalités (exemple) -->
            <div class="relative">
              <div id="featureCarousel" class="flex overflow-x-auto snap-x space-x-4 p-4">
                  <!-- Feature Card 1 -->
                  <div class="snap-start w-full md:w-1/2 lg:w-1/3 p-4 bg-white rounded-lg shadow-md flex-shrink-0">
                      <img src="images/geolocation.jpg" alt="Géolocalisation Précise" class="rounded-md mb-4 h-40 object-cover w-full">
                      <h3 class="text-xl font-semibold text-gray-700 mb-2">Géolocalisation Précise</h3>
                      <p class="text-gray-600">Trouvez les questions et réponses les plus proches de vous.</p>
                  </div>
                  <!-- Feature Card 2 -->
                  <div class="snap-start w-full md:w-1/2 lg:w-1/3 p-4 bg-white rounded-lg shadow-md flex-shrink-0">
                      <img src="images/search.jpg" alt="Recherche Avancée" class="rounded-md mb-4 h-40 object-cover w-full">
                      <h3 class="text-xl font-semibold text-gray-700 mb-2">Recherche Avancée</h3>
                      <p class="text-gray-600">Filtrez les questions par mots-clés, catégories et emplacement.</p>
                  </div>
                  <!-- Feature Card 3 -->
                  <div class="snap-start w-full md:w-1/2 lg:w-1/3 p-4 bg-white rounded-lg shadow-md flex-shrink-0">
                      <img src="images/notifications.jpg" alt="Notifications Personnalisées" class="rounded-md mb-4 h-40 object-cover w-full">
                      <h3 class="text-xl font-semibold text-gray-700 mb-2">Notifications Personnalisées</h3>
                      <p class="text-gray-600">Soyez averti des nouvelles questions et réponses qui vous intéressent.</p>
                  </div>
                </div>
                <!-- Navigation du Carrousel (Boutons) -->
                <div class="absolute top-1/2 transform -translate-y-1/2 left-2">
                  <button onclick="scrollCarousel(-1)" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-full">
                    <i class="fas fa-chevron-left"></i>
                  </button>
                </div>
                <div class="absolute top-1/2 transform -translate-y-1/2 right-2">
                  <button onclick="scrollCarousel(1)" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-full">
                    <i class="fas fa-chevron-right"></i>
                  </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Section "Témoignages" -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Ce que nos utilisateurs disent</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-gray-700 italic">"[Plateforme] m'a permis de trouver des réponses à des questions locales que je ne trouvais nulle part ailleurs."</p>
                    <p class="mt-4 font-semibold text-gray-800">- John Doe, Paris</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-lg shadow-md">
                    <p class="text-gray-700 italic">"J'adore la communauté active de [Plateforme]. J'ai rencontré des gens formidables et appris plein de choses."</p>
                    <p class="mt-4 font-semibold text-gray-800">- Jane Smith, Lyon</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section "Appel à l'Action Final" -->
    <section class="py-24 bg-emerald-100">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-emerald-800 mb-8">Prêt à explorer votre communauté ?</h2>
            <p class="text-xl text-emerald-700 mb-8">Rejoignez notre communauté et découvrez les réponses aux questions qui vous intéressent.</p>
            <a href="#" class="inline-block bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-4 px-12 rounded-full transition duration-300">
                S'inscrire gratuitement
            </a>
        </div>
    </section>

    <!-- Pied de Page -->
    <footer class="bg-gray-800 py-8 text-white text-center">
        <div class="container mx-auto">
            <p>© 2025 Plateforme de Questions Locales. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/YOUR_FONT_AWESOME_KIT.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>