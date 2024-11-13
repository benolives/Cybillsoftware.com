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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('email');
            $table->string('phone_number');
            $table->decimal('amount', 8, 2);
            $table->string('status')->default('pending');
            $table->string('checkout_request_id')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('result_description')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
