<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = DotEnv::create(__DIR__);
$dotenv->load();

// test code, should output:
// api://default
// when you run $ php bootstrap.php
echo getenv('OKTAAUDIENCE');