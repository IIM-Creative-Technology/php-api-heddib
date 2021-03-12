<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('note');

            // Intervenant
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');

            // Promotion
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');

            // Je laisse le timestamps car dans ce genre de table c'est utile
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
