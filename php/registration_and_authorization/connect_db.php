<?php

session_start();

$conn_name = getenv('DB_USER') ?: 'root';
$conn_pass = getenv('DB_PASS') ?: '';
$host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'reg-db';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $conn_name, $conn_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $exception) {
    error_log("Ошибка подключения к БД: " . $exception->getMessage());
    die("Ошибка подключения к базе данных.");
}