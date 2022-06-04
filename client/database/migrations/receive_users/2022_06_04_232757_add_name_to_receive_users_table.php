<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('receive_users', function (Blueprint $table) {
            $table->string('name', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::table('receive_users', function (Blueprint $table) {
            $table->removeColumn('name');
        });
    }
};
