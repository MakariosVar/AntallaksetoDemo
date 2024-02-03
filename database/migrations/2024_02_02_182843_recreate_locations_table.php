<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop the existing 'locations' table if it exists
        Schema::dropIfExists('locations');

        // Create the 'locations' table with specified columns
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name_el');
            $table->string('name_eng');
            $table->decimal('latitude', 10, 7); // Adjust precision and scale as needed
            $table->decimal('longitude', 10, 7); // Adjust precision and scale as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop the 'locations' table if the migration is rolled back
        Schema::dropIfExists('locations');
    }
}