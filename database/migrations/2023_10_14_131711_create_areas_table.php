<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('name'); // Name of the room
            $table->integer('capacity')->nullable(); // Room's capacity
            $table->text('description')->nullable(); // Room description (optional)
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('rental_cost', 10, 2); // Rental cost with two decimal places
            $table->boolean('availability')->default(true); // Availability (default to true)
            $table->foreignId('places_id')->nullable()->constrained('places')->onDelete('cascade');

            // Add more columns as needed

            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('areas');
    }
};
