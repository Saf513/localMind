<?php
namespace Database\Factories;

use App\Models\Answer;
use App\Models\BaseUser;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'user_id' => BaseUser::factory(), // Génère un user aléatoire
            'question_id' => Question::factory(), // Génère une question aléatoire
            'content' => $this->faker->paragraph(3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
