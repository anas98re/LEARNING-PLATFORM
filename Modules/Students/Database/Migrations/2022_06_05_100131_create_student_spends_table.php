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
        Schema::create('student_spends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('balance_before')->default(0);
            $table->unsignedBigInteger('balance');
            $table->unsignedBigInteger('balance_after')->default(0);
            $table->unsignedBigInteger('student_receiver_id')->nullable();
            $table->unsignedBigInteger('subscription_id')->nullable();
            $table->boolean('is_aproved')->default(true);
            $table->foreign('student_receiver_id')->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')
                ->onDelete('cascade');
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
        Schema::dropIfExists('student_spends');
    }
};
