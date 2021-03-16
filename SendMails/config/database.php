<?php

use Illuminate\Database\Capsule\Manager as Conexion;
use Dotenv\Dotenv;

$conexion = new Conexion;

$host       = getenv('DB_HOST');
$port       = getenv('DB_PORT');
$db         = getenv('DB_DATABASE');
$user       = getenv('DB_USERNAME');
$pass       = getenv('DB_PASSWORD');
$charset    = getenv('DB_CHARSET');
$driver     = getenv('DB_CONECTOR'); 
$collation  = getenv('DB_COLLATION');
$prefix     = getenv('DB_PREFIX');

$conexion->addConnection([
    'driver'    => $driver,
    'host'      => $host,
    'database'  => $db,
    'username'  => $user,
    'password'  => $pass,
    'charset'   => $charset,
    'collation' => $collation,
    'prefix'    => $prefix
]);


$conexion->bootEloquent();