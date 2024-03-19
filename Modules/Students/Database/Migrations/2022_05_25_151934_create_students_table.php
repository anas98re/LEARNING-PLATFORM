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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('school');
            $table->text('weaknesses_subjects');
            $table->text('strong_subjects');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('birthday');
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('points')->default(0);
            $table->unsignedBigInteger('balance')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('guardian_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onUpdate('cascade')
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
        Schema::dropIfExists('students');
    }
};
