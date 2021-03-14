<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Intervenant;
use App\Models\Note;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Disable forein key checks before truncating all tables
        Schema::disableForeignKeyConstraints();

        Course::truncate();
        Intervenant::truncate();
        Note::truncate();
        Promotion::truncate();
        Student::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();
        //

        Promotion::factory(3)->create();
        Student::factory(8)->create();
        Intervenant::factory(3)->create();
        Course::factory(8)->create();
        Note::factory(30)->create();

        User::factory(3)->state(new Sequence(
            [
                'name' => 'Alexis',
                'email' => 'alexis@gmail.com',
            ],
            [
                'name' => 'Karine',
                'email' => 'karine@gmail.com',
            ],
            [
                'name' => 'Nicolas',
                'email' => 'nicolas@gmail.com',
            ]
        ))->create();
    }
}
