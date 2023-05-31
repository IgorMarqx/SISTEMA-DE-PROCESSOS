<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lawyers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id_1')->unsigned()->nullable();
            $table->foreign('user_id_1')->references('id')->on('users');
            $table->string('email_lawyer_1')->nullable();
            $table->integer('user_id_2')->unsigned()->nullable();
            $table->foreign('user_id_2')->references('id')->on('users');
            $table->string('email_lawyer_2')->nullable();
            $table->integer('user_id_3')->unsigned()->nullable();
            $table->foreign('user_id_3')->references('id')->on('users');
            $table->string('email_lawyer_3')->nullable();
            $table->integer('user_id_4')->unsigned()->nullable();
            $table->foreign('user_id_4')->references('id')->on('users');
            $table->string('email_lawyer_4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyers');
    }
};
