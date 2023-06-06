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
        Schema::create('requeriments', function (Blueprint $table) {
            $table->id();
            $table->string('oficio_num');
            $table->string('destinatario');
            $table->string('office');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->string('coord_1')->nullable();
            $table->string('coord_2')->nullable();
            $table->string('coord_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requeriments');
    }
};
