<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasperskyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaspersky_products', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key (`id` column)
            $table->integer('product_api_id')->unique(); // `product_api_id` as unique
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable(); // Allow `description` to be nullable
            $table->timestamp('last_updated_at')->nullable(); // `last_updated_at` as nullable
            $table->timestamps(0); // `created_at` and `updated_at` with default timestamps

            // If you want to explicitly specify the charset, you can use `charset()` as well.
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
     {
         Schema::dropIfExists('kaspersky_products');
     }
}