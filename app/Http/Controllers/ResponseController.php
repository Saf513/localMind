<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ResponseController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $response = $question->responses()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id()
        ]);

        // Mise à jour du compteur de réponses
        $question->increment('answers_count');

        if ($request->ajax()) {
            return response()->json([
                'response' => $response->load('user'),
                'message' => 'Réponse ajoutée avec succès'
            ]);
        }

        return back()->with('success', 'Réponse ajoutée avec succès');
    }

    public function destroy(Answer $response)
    {
        $this->authorize('delete', $response);
        
        $question = $response->question;
        $response->delete();
        $question->decrement('answers_count');

        return back()->with('success', 'Réponse supprimée avec succès');
    }
}
