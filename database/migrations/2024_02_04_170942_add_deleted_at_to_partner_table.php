<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPartnerTable extends Migration
{
    public function up()
    {
        Schema::table('partner', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('partner', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}