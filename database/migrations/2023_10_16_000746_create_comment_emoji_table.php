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
        Schema::create('commentaire_emoji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('commentaire_id');
            $table->unsignedBigInteger('emoji_id');
            $table->timestamps();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('commentaire_id')->references('id')->on('commentaires')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emoji_id')->references('id')->on('emojis')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_emoji');
    }
};
