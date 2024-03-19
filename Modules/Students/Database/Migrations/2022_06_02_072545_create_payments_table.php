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
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('balance');
            $table->text('payment_image')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->boolean('is_aproved')->default(false);
            $table->unsignedBigInteger('balance_after')->default(0);
            $table->unsignedBigInteger('balance_before')->default(0);
            $table->foreign('student_id')->references('id')->on('students')
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
        Schema::dropIfExists('payments');
    }
};
