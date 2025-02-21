<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class QuestionSeeder extends Seeder
{
    public function run()
    {
        Question::factory(100)->create();

    }
}