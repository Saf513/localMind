<div class="bg-white rounded-lg shadow-md p-4 mb-4">
    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $question->title }}</h2>
    <p class="text-gray-700">{{ Str::limit($question->content, 200) }}</p>
    <div class="flex justify-between items-center mt-4">
        <span class="text-gray-500 text-sm">{{ $question->created_at->diffForHumans() }}</span>
        <a href="{{ route('questions.show', $question) }}" class="text-blue-500 hover:text-blue-700">Voir plus</a>
    </div>
</div>