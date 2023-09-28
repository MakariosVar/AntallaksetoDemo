<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePhoneNullableInPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Make the 'phone' column nullable
            $table->string('phone')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // If you ever need to revert the changes, you can define the 'down' method here.
            // However, making a column nullable is usually a one-way operation and may not need a 'down' method.
        });
    }
}
