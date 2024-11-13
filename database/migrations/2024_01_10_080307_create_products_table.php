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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('product_name');
            $table->string('product_plan_name')->nullable();
            $table->string('description')->nullable();
            $table->integer('reviews')->default(0);
            $table->double('discount_percentage', 8, 2)->nullable();
            $table->json('compatibility')->nullable();
            $table->json('benefits')->nullable();
            $table->string('learn_more_link')->nullable();
            $table->string('product_link')->nullable();
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_offer')->nullable();
            $table->unsignedInteger('price_partner')->nullable();
            $table->double('commission_percentage', 8, 2)->nullable();
            $table->enum('stock_status', ['instock', 'outofstock']);
            $table->unsignedInteger('quantity')->default(0);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
