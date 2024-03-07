<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSoftdeletesFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the column exists before trying to drop it
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add the deleted_at column back if this migration is rolled back
            $table->softDeletes();
        });
    }
}