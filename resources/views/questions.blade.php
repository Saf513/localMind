<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qwesta - Questions et Réponses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script> 
   <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation élégante -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <h1 class="text-3xl font-bold text-indigo-600">Qwesta</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-indigo-600 transition duration-300">
                        <i class="fas fa-plus-circle mr-2"></i><a href="/poseQuestions">Poser une Question</a>
                    </a>
                    <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">
                        Connexion
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Colonne Principales des Questions -->
            <div class="md:col-span-2 space-y-6">
                @foreach ($questions as $question)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <!-- En-tête de la Question -->
                        <div class="bg-gray-50 p-4 border-b">
                            <div class="flex items-center space-x-4">
                                <img 
                                    src="https://ui-avatars.com/api/?name={{ urlencode($question->BaseUser->name ?? 'Q') }}" 
                                    alt="Avatar" 
                                    class="w-10 h-10 rounded-full"
                                >
                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $question->BaseUser->name ?? 'Utilisateur' }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $question->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Contenu de la Question -->
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                {{ $question->title }}
                            </h2>
                            <p class="text-gray-700 mb-4">
                                {{ $question->content }}
                            </p>

                            <!-- Actions (Like, Commenter) -->
                            <div class="flex items-center space-x-4 mt-4">
                                <button class="flex items-center text-gray-600 hover:text-red-500 transition">
                                    <i class="fas fa-heart mr-2"></i>
                                    <span>{{ $question->likes_count ?? rand(0, 50) }} Likes</span>
                                </button>
                                <button class="flex items-center text-gray-600 hover:text-indigo-500 transition">
                                    <i class="fas fa-comment mr-2"></i>
                                    <span>{{ $question->answers->count() }} Réponses</span>
                                </button>
                            </div>

                            <!-- Section Réponses -->
                            <div class="mt-6 space-y-4">
                                <h3 class="text-xl font-semibold text-gray-800 border-b pb-2">
                                    Réponses ({{ $question->answers->count() }})
                                </h3>

                                @forelse ($question->answers as $answer)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <img 
                                                src="https://ui-avatars.com/api/?name={{ urlencode($answer->user->name ?? 'R') }}" 
                                                alt="Avatar Répondant" 
                                                class="w-8 h-8 rounded-full"
                                            >
                                            <div>
                                                <p class="font-semibold text-gray-800">
                                                    {{ $answer->user->name ?? 'Anonyme' }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $answer->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $answer->content }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 italic">Aucune réponse pour le moment</p>
                                @endforelse
                            </div>

                            <!-- Formulaire de Réponse -->
                            <form class="mt-6 pt-4 border-t">
                                <div class="flex space-x-3">
                                    <input 
                                        type="text" 
                                        placeholder="Votre réponse..." 
                                        class="flex-grow border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                    >
                                    <button 
                                        type="submit" 
                                        class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition"
                                    >
                                        Envoyer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $questions->links() }}
                </div>
            </div>

            <!-- Colonne Latérale -->
            <div class="hidden md:block">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Statistiques</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Questions</span>
                            <span class="font-bold text-indigo-600">{{ $questions->total() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Questions Aujourd'hui</span>
                            <span class="font-bold text-green-600">{{ rand(5, 20) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Utilisateurs Actifs</span>
                            <span class="font-bold text-blue-600">{{ rand(100, 500) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>&copy; 2024 Qwesta. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>