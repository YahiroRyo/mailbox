<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mail_deletes', function (Blueprint $table) {
            $table->foreignId('mail_id')->primary();

            $table->timestamp('created_at')->useCurrent();

            $table->foreign('mail_id')->references('mail_id')->on('mails');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_deletes');
    }
};
