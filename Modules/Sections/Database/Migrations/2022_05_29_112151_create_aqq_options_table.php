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
        Schema::create('aqq_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aqq_id');
            $table->text('answear');
            $table->boolean('is_true')->default(false);
            $table->foreign('aqq_id')->references('id')->on('automated_quiz_questions')->onDelete('cascade');
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
        Schema::dropIfExists('aqq_options');
    }
};
