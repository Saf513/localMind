<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('base_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_type'); 
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('CREATE TABLE regular_users (
            last_latitude DECIMAL(10, 8),
            last_longitude DECIMAL(11, 8)
        ) INHERITS (base_users)');

        DB::statement('CREATE TABLE admins (
           
        ) INHERITS (base_users)');

        DB::statement('CREATE INDEX regular_users_email_idx ON regular_users (email)');
        DB::statement('CREATE INDEX admins_email_idx ON admins (email)');

        DB::statement('
            CREATE UNIQUE INDEX unique_email_across_users 
            ON base_users (email) 
            WHERE user_type = \'base\'
        ');
        
        DB::statement('
            CREATE UNIQUE INDEX unique_email_regular_users 
            ON regular_users (email) 
            WHERE user_type = \'regular\'
        ');
        
        DB::statement('
            CREATE UNIQUE INDEX unique_email_admins 
            ON admins (email) 
            WHERE user_type = \'admin\'
        ');
    }

    public function down()
    {
        Schema::dropIfExists('admins');
        Schema::dropIfExists('regular_users');
        Schema::dropIfExists('base_users');
    }
};

