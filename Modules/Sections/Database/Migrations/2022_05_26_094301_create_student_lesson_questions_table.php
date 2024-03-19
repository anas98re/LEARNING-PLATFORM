<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lesson_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lesson_questions_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('point')->default(0);
            $table->boolean('student_has_show');
            $table->foreign('lesson_questions_id')->references('id')->on('lesson_questions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('student_lesson_questions');
    }
};
