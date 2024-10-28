<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meal_id')->index();
            $table->unsignedBigInteger('language_id')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_translations');
    }
};
