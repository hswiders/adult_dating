<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('dob_d');
            $table->string('dob_m');
            $table->string('dob_y');
            $table->string('gender');
            $table->integer('occupation');
            $table->string('image')->default('/uploads/default.png');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('spoken_language')->nullable();
            $table->string('display_language')->nullable();
            $table->string('nationality')->nullable();
            $table->string('height')->nullable();
            $table->string('have_tatto')->default('I dont answer');
            $table->string('is_smoker')->default('I dont answer');
            $table->string('marital_status')->default('I dont answer');
            $table->string('have_children')->default('I dont answer');
            $table->integer('education')->default(0);
            $table->integer('email_verified_at')->nullable();
            $table->integer('is_verified')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('users');
    }
};
