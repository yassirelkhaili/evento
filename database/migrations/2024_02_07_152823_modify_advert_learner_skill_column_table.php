<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAdvertLearnerSkillColumnTable extends Migration
{
    public function up()
    {
        Schema::table('advert_learner_skill', function (Blueprint $table) {
            $table->foreignId('advert_id')->nullable()->change();
            $table->foreignId('learner_id')->nullable()->change();
            $table->foreignId('skill_id')->nullable(false)->change();
            // Add any additional changes if needed
        });
    }

    public function down()
    {
        Schema::table('advert_learner_skill', function (Blueprint $table) {
            $table->foreignId('advert_id')->constrained()->onDelete('cascade')->change();
            $table->foreignId('learner_id')->constrained()->onDelete('cascade')->change();
            $table->foreignId('skill_id')->constrained()->onDelete('cascade')->change();
            // Add any additional changes for rollback if needed
        });
    }
}
