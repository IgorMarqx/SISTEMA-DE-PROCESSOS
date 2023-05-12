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
        Schema::create('proccesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('url_proccess', 2048);
            $table->string('email_coorporative');
            $table->string('email_client');
            $table->integer('qtd_update')->nullable();
            $table->integer('qtd_finish')->nullable();
            $table->integer('reopen_proccess')->nullable();
            $table->boolean('progress_proccess')->default(0);
            $table->boolean('finish_proccess')->default(0);
            $table->boolean('update_proccess')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proccesses');
    }
};
