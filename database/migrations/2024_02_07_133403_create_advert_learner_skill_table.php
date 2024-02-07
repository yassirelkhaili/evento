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
        Schema::create('advert_learner_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advert_id')->constrained('advert', 'id')->onDelete('cascade');
            $table->foreignId('learner_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained('skill', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_learner_skill');
    }
};
