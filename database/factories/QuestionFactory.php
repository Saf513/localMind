<?php
namespace Database\Factories;

use App\Models\Question;
use App\Models\BaseUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => BaseUser::factory(), // Génère un user aléatoire
            'title' => $this->faker->sentence(6),
            'content' => $this->faker->paragraph(3),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'location_name' => $this->faker->city(),
            'favorites_count' => $this->faker->numberBetween(0, 100),
            'answers_count' => $this->faker->numberBetween(0, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
