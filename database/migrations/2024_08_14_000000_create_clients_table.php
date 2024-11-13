<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id');
            $table->foreign('partner_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('partner_name');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('subscription_type', ['monthly', 'annually']);
            $table->string('country');
            $table->string('town');
            $table->string('address');
            $table->string('product_category');
            $table->decimal('product_price', 10, 2);
            $table->decimal('commission_received', 10, 2);
            $table->timestamp('expires_at')->nullable();
            $table->enum('status', ['complete', 'incomplete'])->default('incomplete');
            $table->string('checkout_request_id')->nullable();
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
        Schema::dropIfExists('clients');
    }
}