<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mail_contents', function (Blueprint $table) {
            $table->char('mail_id', 26)->primary();

            $table->string('subject', 256);
            $table->text('body', 384000);
            $table->string('cc')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_contents');
    }
};
