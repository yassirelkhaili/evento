<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeStatusColumnInEventsTableToEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Using raw SQL to add the ENUM column
        DB::statement("ALTER TABLE events ADD status ENUM('pending', 'published') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Assuming the original 'status' column was a string with default 'pending'
        Schema::table('events', function (Blueprint $table) {
            $table->string('status')->default('pending');
        });
    }
}
