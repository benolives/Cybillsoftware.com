<?php
echo "<pre>";
// Refresh Laravel autoload and clear caches
echo "Running: php artisan config:cache\n";
passthru('php artisan config:cache 2>&1');

echo "Running: php artisan route:cache\n";
passthru('php artisan route:cache 2>&1');

echo "Running: php artisan view:cache\n";
passthru('php artisan view:cache 2>&1');

echo "Running: php artisan clear-compiled\n";
passthru('php artisan clear-compiled 2>&1');

echo "Running: composer dump-autoload\n";
passthru('composer dump-autoload 2>&1');

echo "Running: php artisan optimize\n";
passthru('php artisan optimize 2>&1');

echo "Autoloader refreshed and caches cleared.";
echo "</pre>";
?>