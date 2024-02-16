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




if(isset($_POST['submit'])){
    //Get user input
    $userID = $_POST['userID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    //validate password length
    if (!validatePassword($password)) {
        $_SESSION['message'] = "Passwords must be more than 8 digits.";
        $_SESSION['msg_type'] = "danger";
        header("Location: register.php");
        exit(); 
    }elseif(!validateUserID($userID)){
        $_SESSION['message'] = "User ID should be in the format 'Uxxx' where x is a digit.";
        $_SESSION['msg_type'] = "danger";
        header("Location: register.php");
        exit(); 
    } elseif (!validateEmail($email)) {
        $_SESSION['message'] = "Invalid email format.";
        $_SESSION['msg_type'] = "danger";
        header("Location: register.php");
        exit(); 
    } elseif (checkExistingUser($conn, $username, $email)) {
        $_SESSION['message'] = "Username or email already exists.";
        $_SESSION['msg_type'] = "danger";
        header("Location: register.php");
        exit(); 
    } else {
        // Hash the password
        $hashedPassword = sha1($password);
        $sql = "INSERT INTO user (user_id, email, first_name, last_name, username, `password`) VALUES ('$userID', '$email', '$firstname', '$lastname', '$username', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully.";
            $_SESSION['message'] = "User registered successfully.";
            $_SESSION['msg_type'] = "success";
            header("Location: register.php");
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    header("Location: index.php");

}
$conn->close();
?>