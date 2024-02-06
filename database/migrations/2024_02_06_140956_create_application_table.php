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
        $statusValues = ['Pending', 'Accepted', 'Rejected', 'Under Review', 'Interview Scheduled', 'Offer Extended', 'Offer Accepted', 'Offer Declined'];
        Schema::create('application', function (Blueprint $table) use ($statusValues) {
            $table->id();
            $table->unsignedBigInteger('learner_id');
            $table->unsignedBigInteger('advert_id');
            $table->enum('status', $statusValues)->default('pending');
            $table->timestamps();
            

            // Foreign keys
            $table->foreign('learner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('advert_id')->references('id')->on('advert')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application');
    }
};
