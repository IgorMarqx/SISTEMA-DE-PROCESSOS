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
        Schema::create('administrative_individuals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('subject');
            $table->string('jurisdiction');
            $table->decimal('cause_value', 20, 2)->nullable();
            $table->boolean('justice_secret')->default(0);
            $table->boolean('free_justice')->default(0);
            $table->boolean('tutelar')->default(0);
            $table->string('priority');
            $table->string('judgmental_organ');
            $table->string('judicial_office');
            $table->string('competence');
            $table->string('url_individuals', 2048)->nullable();
            $table->string('url_noticies', 2048)->nullable();
            $table->string('email_coorporative');
            $table->string('email_client')->nullable();
            $table->integer('qtd_update')->nullable();
            $table->integer('qtd_finish')->nullable();
            $table->boolean('progress_individuals')->default(0);
            $table->boolean('finish_individuals')->default(0);
            $table->boolean('update_individuals')->default(0);
            $table->string('action_type');
            $table->integer('is_AdmIndividual')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrative_individuals');
    }
};
