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
        Schema::create('student_aqq', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aqq_option_id');
            $table->unsignedBigInteger('point')->default(0);
            $table->foreign('aqq_option_id')->references('id')->on('aqq_options')->onDelete('cascade');
            $table->unsignedBigInteger('aqq_id');
            $table->foreign('aqq_id')->references('id')->on('automated_quiz_questions')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
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
        Schema::dropIfExists('student_aqq');
    }
};
