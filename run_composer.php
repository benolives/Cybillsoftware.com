<?php
echo "<pre>";

// Set environment variables for Composer
putenv('HOME=' . __DIR__);
putenv('COMPOSER_HOME=' . __DIR__);

echo "Running: composer dump-autoload\n";
// Run composer dump-autoload
passthru('composer dump-autoload 2>&1');

echo "</pre>";
?>