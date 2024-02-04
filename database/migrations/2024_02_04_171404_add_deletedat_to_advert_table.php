<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class addDeletedAtToAdvertTable extends Migration
{
    public function up()
    {
        Schema::table('advert', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('advert', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}