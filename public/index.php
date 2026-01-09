<?php

$envPath = __DIR__ . '/../.env';
if (!file_exists($envPath)) {
    die('Error: .env file not found at ' . $envPath);
}

$env = parse_ini_file($envPath);

foreach ($env as $key => $value) {
    $_ENV[$key] = $value;

}

require_once __DIR__ . '/../app/config/database.php';

$db = new Database();
$conn = $db->connect();

echo 'Conexion OK';