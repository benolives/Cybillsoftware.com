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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // User's email, unique constraint
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for email verification, nullable
            $table->string('password'); // User's password
            $table->string('utype')->default('USR'); // User type, default is 'USR'
           // $table->string('profile_image')->nullable(); // User's profile image, nullable
            $table->string('name_of_company'); // User's company name
            $table->string('phone'); // User's phone number
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop the users table if it exists
    }
};