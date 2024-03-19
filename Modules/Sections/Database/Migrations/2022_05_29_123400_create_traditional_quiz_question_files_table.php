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
        Schema::create('traditional_quiz_questions_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('traditional_quiz_id');
            $table->foreign('traditional_quiz_id')->references('id')->on('traditional_quizzes')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->text('file_link');

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
        Schema::dropIfExists('traditional_quiz_question_files');
    }
};
