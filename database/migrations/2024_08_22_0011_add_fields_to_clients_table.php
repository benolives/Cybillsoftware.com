<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('product_name')->after('phone'); // New field
            $table->decimal('product_price', 10, 2)->after('product_name');
             $table->decimal('commission_received', 8, 2)->after('product_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->dropColumn('product_price');
            $table->dropColumn('commission_received');
        });
    }
}