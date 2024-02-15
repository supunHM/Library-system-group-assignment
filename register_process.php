<?php
session_start();
require_once('db-connection.php');
?>

<?php

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password length
function validatePassword($password) {
    return strlen($password) >= 8;
}

// Function to validate user ID format
function validateUserID($userID) {
    return preg_match("/^U\d{3}$/", $userID);
}

// Function to check if username or email already exists
function checkExistingUser($conn, $username, $email) {
    $sql = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);
    if ($result === false) {
        echo "Error: " . $conn->error;
        return false; // Return false to indicate an error
    }
    return $result->num_rows > 0;
}

?> 