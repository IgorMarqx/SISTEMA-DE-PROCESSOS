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
        Schema::create('defendants', function (Blueprint $table) {
            $table->id();
            $table->string('defendant');
            $table->string('cnpj')->nullable();
            $table->integer('judicial_collective_id')->nullable();
            $table->foreign('judicial_collective_id')->references('id')->on('judicial_collectives');
            $table->integer('administrative_collective_id')->nullable();
            $table->foreign('administrative_collective_id')->references('id')->on('administrative_collectives');
            $table->integer('judicial_individual_id')->nullable();
            $table->foreign('judicial_individual_id')->references('id')->on('judicial_individuals');
            $table->integer('administrative_individual_id')->nullable();
            $table->foreign('administrative_individual_id')->references('id')->on('administrative_individuals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defendants');
    }
};
