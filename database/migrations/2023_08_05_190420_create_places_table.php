<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('capacity')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->text('facilities')->nullable();
            $table->string('accessibility')->nullable();
            $table->text('internal_rules')->nullable();
            $table->text('photos')->nullable();
            $table->string('website')->nullable();
            $table->string('phone_number')->nullable();

            $table->text('social_media_links')->nullable();
            $table->text('comments_and_reviews')->nullable();
            $table->text('past_events')->nullable();
            $table->text('upcoming_events')->nullable();
            $table->text('internal_notes')->nullable();
            $table->string('status')->nullable();
            $table->text('opening_hours')->nullable();
            $table->text('parking_fees')->nullable();
            $table->text('catering_services')->nullable();
            $table->text('booking_conditions')->nullable();
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
        Schema::dropIfExists('places');
    }
};
