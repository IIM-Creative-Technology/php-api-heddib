<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Note;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'note' => $this->faker->numberBetween(0, 20),
            'student_id' => Student::all()->random()->id,
            'course_id' => Course::all()->random()->id,
        ];
    }
}
