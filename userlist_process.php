<?php
 require_once('db-connection.php');
 session_start();
?>
<?php

if(isset($_GET['delete'])){
    $userId = $_GET['delete'];

    $sql = "DELETE FROM user WHERE user_id = '$userId'";

    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = 'danger';

    header("Location: user_list.php");

}