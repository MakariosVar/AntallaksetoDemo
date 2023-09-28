<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Store the user's ID
            $table->string('token', 60)->unique(); // Unique token
            $table->timestamp('expires_at'); // Token expiration timestamp
            $table->timestamps();

            // Define foreign key relationship with the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_tokens');
    }
}
