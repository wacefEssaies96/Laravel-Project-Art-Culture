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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('Card_Security_Code', 10);
            $table->string('Cardholder_Name', 50);
            $table->decimal('Card_Number', 20);
            $table->timestamp('Card_Expiration_Date');
            $table->string('Address', 20);
            $table->string('payment_method', 20);

             
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
        Schema::dropIfExists('payments');
    }
};
