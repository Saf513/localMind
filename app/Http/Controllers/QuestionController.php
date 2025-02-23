<?php
namespace App\Http\Controllers;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class QuestionController extends Controller
{
    public function showQuestions(Request $request){
      $questions = Question::with('answers.user') 
        ->paginate(9);
        $cacheKey = 'questions_page_' . $request->get('page', 1);

        // Utiliser remember au lieu de put
        $questions = Cache::remember($cacheKey, 60, function () {
            return Question::with('answers.user')->paginate(9);
        });
        $questions = Cache::remember('questions', 60, function() {
          return Question::with('answers.user')->paginate(9);
      });
       return view('questions',compact('questions'));
     }

      public function showPoseQuestions()
      {
      
          return view('poseQuestion');
      }
     
     public function store(Request $request){
    
        $validated = $request->validate([
            'questionTitle' => 'required|max:100',
            'questionDetails' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_name' => 'nullable|string|max:255'
        ]);

        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $validated['questionTitle'],
            'content' => $validated['questionDetails'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'location_name' => $validated['location_name'] ?? null
        ]);

        return redirect()->route('questions')->with('success', 'Réponse ajoutée avec succès!');
      }
}
