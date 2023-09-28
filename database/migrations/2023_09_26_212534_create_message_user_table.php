<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageUserTable extends Migration
{
    public function up()
    {
        Schema::create('message_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('message_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('message_user');
    }
}
