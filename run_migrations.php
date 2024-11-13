<?php

// Load the Laravel application
require __DIR__.'/bootstrap/autoload.php'; // Adjust the path if necessary
$app = require_once __DIR__.'/bootstrap/app.php';

// Create a Kernel instance
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle($request = Illuminate\Http\Request::capture());

// Run migrations
Artisan::call('migrate');
echo "Migrations have been run successfully!";

// Optionally, you can output the results
echo nl2br(Artisan::output());