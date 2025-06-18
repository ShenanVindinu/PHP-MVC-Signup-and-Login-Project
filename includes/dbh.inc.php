<?php

$localhost = 'localhost';
$dbname = 'mydatabase';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO("mysql:host=$localhost;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
