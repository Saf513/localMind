<?php

namespace Database\Seeders;

use App\Models\BaseUser;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    public function run()
    {
        
        BaseUser::factory(100)->create();
    }
}
