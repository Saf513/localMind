<?php
namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function showQuestions(Request $request){
      $questions = Question::with('answers.user') // Charger les réponses et l'utilisateur de chaque réponse
        ->paginate(9);

       return view('questions',compact('questions'));
     }

      public function showPoseQuestions()
      {
      
          return view('poseQuestion');
      }
     
     public function store(Request $request){
    // {
        $validated = $request->validate([
            'questionTitle' => 'required|max:255',
            'questionDetails' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_name' => 'nullable|string|max:255'
        ]);

        $question = Question::create([
            // 'user_id' => auth()->id(), // Assurez-vous d'être authentifié
            'title' => $validated['questionTitle'],
            'content' => $validated['questionDetails'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'location_name' => $validated['location_name'] ?? null
        ]);

        return redirect()->route('questions', $question)->with('success', 'Question créée avec succès !');

      }
}
