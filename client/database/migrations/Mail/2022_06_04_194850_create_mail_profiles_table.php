<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mail_profiles', function (Blueprint $table) {
            $table->char('mail_id', 26)->primary();

            $table->foreignId('receive_user_id');
            $table->string('mail_text_url', 256);
            $table->timestamp('mail_created_at');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_profiles');
    }
};
