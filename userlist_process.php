<?php
 require_once('db-connection.php');
 session_start();
?>
<?php

$update = false;
$userId = "";
$userName = "";
$firstName = "";
$lastName = "";
$email = "";

if(isset($_GET['delete'])){
    $userId = $_GET['delete'];

    $sql = "DELETE FROM user WHERE user_id = '$userId'";

    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = 'danger';

    header("Location: user_list.php");

}

if(isset($_GET['edit'])){
    $userId = $_GET['edit'];
    $update = true;

    $result = $conn->query("SELECT * FROM user WHERE user_id = '$userId'") or die($conn->error);

    if(count(array($result))==1){
        $row = $result->fetch_array() or die($conn->error);
        $userId = $row['user_id'];
        $userName = $row['username'];
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $email = $row['email'];

    }
}