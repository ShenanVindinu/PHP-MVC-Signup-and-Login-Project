<?php

declare(strict_types=1);

function get_username(object $pdo, string $username) {

    $query = "SELECT username FROM users WHERE username = :username;";
    $stmt = $pdo->prepare($query); //This separate the data from actual query
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email) {

    $query = "SELECT username FROM users WHERE username = :email;";
    $stmt = $pdo->prepare($query); //This separate the data from actual query
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}