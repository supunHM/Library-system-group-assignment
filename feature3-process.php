<?php
 require_once('db-connection.php');
 session_start();

 $update = false;
 $cId = "";
 $cName = "";

 //Save data from form
 if(isset($_POST['save'])){
    $cId = $_POST['category_id'];
    $cName = $_POST['category_name'];

    if (!preg_match('/^C\d{3}$/', $cId)) {
        $_SESSION['message'] = "Category ID must be in the format C001.";
        $_SESSION['msg_type'] = "danger";
        header("Location:feature3.php");
        
    }else{
   
    require_once('db-connection.php');
    $sql = "INSERT INTO bookcategory(category_id,category_Name,date_modified) VALUES ('$cId','$cName',NOW())";

    $conn->query($sql) or die($conn->error);
    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("Location:feature3.php");
    exit();
    }
}

if(isset($_GET['delete'])){
    $cId = $_GET['delete'];

    $sql = "DELETE FROM bookcategory WHERE category_id = '$cId'";

    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = 'danger';

    header("Location:feature3.php");

}

if(isset($_GET['edit'])){
    $eId = $_GET['edit'];
    $update = true;

    $result = $conn->query("SELECT * FROM bookcategory WHERE category_id = '$eId'") or die($conn->error);

    if(count(array($result))==1){
        $row = $result->fetch_array() or die($conn->error);
        $cId = $row['category_id'];
        $cName = $row['category_Name'];
    }
}

if(isset($_POST['update'])){
    $cId = $_POST['category_id'];
    $cName = $_POST['category_name'];
    

    $sql = "UPDATE bookcategory SET category_id='$cId',category_Name='$cName',date_modified=NOW() WHERE category_id='$cId';";
    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location:feature3.php");

}

?>