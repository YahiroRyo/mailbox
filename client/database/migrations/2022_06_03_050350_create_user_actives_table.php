<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_actives', function (Blueprint $table) {
            $table->foreignId('user_id')->primary();

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_actives');
    }
};
