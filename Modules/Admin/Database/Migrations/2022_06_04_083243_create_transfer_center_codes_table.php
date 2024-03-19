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
        Schema::create('transfer_center_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_center_id');
            $table->text('code');
            $table->boolean('is_transfer')->default(false);
            $table->date('transfer_date')->nullable();
            $table->unsignedBigInteger('balance');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('transfer_center_id')->references('id')->on('transfer_centers')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')
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
        Schema::dropIfExists('transfer_center_codes');
    }
};
