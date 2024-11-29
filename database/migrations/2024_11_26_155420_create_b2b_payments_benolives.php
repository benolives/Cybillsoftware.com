<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('b2b_payments_benolives', function (Blueprint $table) {
            $table->bigIncrements('id');                                // Auto-incrementing primary key
            $table->string('transaction_id');                            // Transaction ID (from M-Pesa API)
            $table->string('originator_conversation_id')->nullable();   // Originator Conversation ID
            $table->string('conversation_id')->nullable();              // M-Pesa Conversation ID
            $table->decimal('amount', 10, 2);                           // Amount paid to Ben Olives (e.g., 1000.00)
            $table->decimal('account_balance', 10, 2)->nullable();      // Account balance after payment
            $table->string('currency_code', 3);                          // Currency code (e.g., KES)
            $table->string('beneficiary_name');                          // Beneficiary name (e.g., "BenOlives")
            $table->string('beneficiary_paybill')->nullable();          // Paybill number for the beneficiary
            $table->bigInteger('product_id')->unsigned();               // Foreign key reference to the product
            $table->bigInteger('client_id')->unsigned();                // Foreign key reference to the client
            $table->decimal('charges', 10, 2)->nullable();              // Charges incurred for the B2B payment
            $table->string('transaction_status', 50)->default('pending'); // Transaction status (Pending, Success, Failed)
            $table->integer('result_code')->nullable();                 // Result code from M-Pesa API (0 = Success, 1 = Failure)
            $table->text('result_desc')->nullable();                    // Description of the transaction result
            $table->timestamps();                                       // Laravel's created_at and updated_at
            $table->dateTime('transaction_completed_time')->nullable(); // Timestamp when the transaction was completed
            $table->string('transaction_reference_number')->nullable(); // Unique reference number for the transaction
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2b_payments_benolives');
    }
};
