<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAdlocationColumnFromPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Use the dropColumn method to remove the 'adlocation' column
            $table->dropColumn('adlocation');
        });
    }

    public function down()
    {
        // If needed, you can define a "down" method to rollback the migration
        // For example, you can recreate the 'adlocation' column here
    }
}
