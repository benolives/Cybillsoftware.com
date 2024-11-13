<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone_number');
            $table->string('country');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('town');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_details');
    }
}