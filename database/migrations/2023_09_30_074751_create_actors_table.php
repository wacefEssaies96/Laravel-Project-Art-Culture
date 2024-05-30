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
        Schema::create('actors', function (Blueprint $table) {
            $table->id();
            $table->string('fullName', 255)->nullable();
            $table->date('birthDate')->nullable();
            $table->string('birthPlace', 255)->nullable();
            $table->text('biography')->nullable();
            $table->string('nationality', 255)->nullable(); 
            // $table->string('specialties', 255)->nullable();
            $table->string('profilePicture', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phoneNumber', 255)->nullable();
            $table->string('socialConnections', 255)->nullable();
            $table->text('discography')->nullable();
            $table->string('availability', 255)->nullable();
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
        Schema::dropIfExists('actors');
    }
};
