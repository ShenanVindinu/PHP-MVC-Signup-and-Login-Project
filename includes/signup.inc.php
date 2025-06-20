<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get form data from POST request
    $username  =  $_POST["username"];
    $pwd       =  $_POST["pwd"];
    $email     =  $_POST["email"];

    try {

        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS
        $errors = [];


        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (is_email_invalid($email)) {
            $errors["invalid email"] = "Invalid email used!";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }

        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "Email Already Registered!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        create_user($pdo, $pwd, $username, $email);

        header("Location: ../index.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    // If the request is not a POST (e.g., direct access), redirect to index.php
    header("Location: ../index.php");
    die();
}
