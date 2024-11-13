<?php
// run_artisan.php

// Ensure error reporting is on for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Path to the artisan file
$artisan = __DIR__ . '/artisan';

// Check if the artisan file exists
if (file_exists($artisan)) {
    echo "Artisan file found.<br>";

    // Execute the artisan command and capture the output
    $output = shell_exec('/usr/bin/php ' . $artisan . ' config:cache 2>&1');

    // Display the output
    echo "<pre>$output</pre>";
} else {
    echo "Artisan file not found.";
}

// Path to your Laravel application's bootstrap file
$appPath = __DIR__ . '/../bootstrap/app.php';

// Include the Composer autoload file
require __DIR__ . '/../vendor/autoload.php';

// Create a new Laravel application instance
$app = require_once $appPath;

// Run the artisan command to create the model and migration
\Illuminate\Support\Facades\Artisan::call('make:model Order -m');

// Output the result
echo 'Model and migration created successfully.';
?>