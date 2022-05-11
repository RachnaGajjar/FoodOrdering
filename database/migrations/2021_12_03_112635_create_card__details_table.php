<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card__details', function (Blueprint $table) {
            $table->id();
            $table->string('card_name');
            $table->string('card_number');
            $table->integer('expire_month');
            $table->integer('expire_year');
            $table->string('card_token');
            $table->unsignedBigInteger('user_id');
            $table->string('customer_id');
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
        Schema::dropIfExists('card__details');
    }
}
