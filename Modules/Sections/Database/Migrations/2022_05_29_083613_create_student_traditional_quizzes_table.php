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
        Schema::create('student_traditional_quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('traditional_quiz_id');
            $table->foreign('traditional_quiz_id')->references('id')->on('traditional_quizzes')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('image_answers');
            $table->integer('deserved_mark');
            $table->boolean('is_corrector')->default(0);
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
        Schema::dropIfExists('student_traditional_quizzes');
    }
};
