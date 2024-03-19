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
        Schema::create(
            'automated_quizzes',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('unit_id')->nullable();
                $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->unsignedBigInteger('lesson_id')->nullable();
                $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->unsignedBigInteger('subject_id')->nullable();
                $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->text('description');
                $table->boolean('isFinal');
                $table->boolean('isAboveLevel');
                $table->text('nameOfQuiz');
                $table->bigInteger('points');
                $table->bigInteger('duration');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automated_quizzes');
    }
};
