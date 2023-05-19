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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('judicial_collective_id')->unsigned()->nullable();
            $table->foreign('judicial_collective_id')->references('id')->on('judicial_collectives');
            $table->integer('administrative_collective_id')->unsigned()->nullable();
            $table->foreign('administrative_collective_id')->references('id')->on('administrative_collectives');
            $table->integer('judicial_individual_id')->unsigned()->nullable();
            $table->foreign('judicial_individual_id')->references('id')->on('judicial_individuals');
            $table->integer('administrative_individual_id')->unsigned()->nullable();
            $table->foreign('administrative_individual_id')->references('id')->on('administrative_individual');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
