<?php

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'benolives_cybillnew',
    'username'  => 'benolives_cybillnew',
    'password'  => 'gTew12B5W^',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Include your migration file
require 'database/migrations/2024_07_22_000001_create_orders_table.php';