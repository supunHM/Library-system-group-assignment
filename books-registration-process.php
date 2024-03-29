<?php
 require_once('db-connection.php');
 session_start();
?>

<?php
$update = false;
$bId = "";
$bName = "";
$bCategory ="";


if(isset($_POST['save'])){
        $bId = $_POST['book_id'];
        $bName = $_POST['book_name'];
        $cName = $_POST['book_category'];

        if (!preg_match('/^B\d{3}$/', $bId)) {
            $_SESSION['message'] = "Book ID must be in the format B001.";
            $_SESSION['msg_type'] = "danger";
            header("Location: books-registration.php");
            exit();
            
        }else{
       
        require_once('db-connection.php');
        
        $sql = "SELECT category_id FROM bookcategory WHERE category_name = '$cName'";
        $result = $conn->query($sql);


        if($result && $result->num_rows > 0){
            $row = $result->fetch_assoc();
            $cId = $row['category_id'];

            // Insert the book details into the book table with the obtained category ID

            $sql = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$bId', '$bName', '$cId')";

            if($conn->query($sql)){
                $_SESSION['message'] = "Record has been saved";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Error: " . $conn->error;
                $_SESSION['msg_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Category name '$cName' not found.";
            $_SESSION['msg_type'] = "danger";
        }

        header("Location: books-registration.php");
        exit();
        }
    }

    if(isset($_GET['delete'])){
        $bId = $_GET['delete'];

        $sql = "DELETE FROM book WHERE book_id = '$bId'";

        $conn->query($sql) or die($conn->error);

        $_SESSION['message'] = "Record has been deleted!";
        $_SESSION['msg_type'] = 'danger';

        header("Location: books-registration.php");

    }


    if(isset($_GET['edit'])){
        $eId = $_GET['edit'];
        $update = true;
    
        // Fetch book details along with category name
        $sql = "SELECT book.*, bookcategory.category_Name 
                FROM book 
                JOIN bookcategory ON book.category_id = bookcategory.category_id 
                WHERE book.book_id = '$eId'";
        $result = $conn->query($sql) or die($con->error);
    
        if($result && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            $bId = $row['book_id'];
            $bName = $row['book_name'];
            $bCategory = $row['category_Name']; // Access category name from the fetched row

        }
    }



    if(isset($_POST['update'])){
        $bId = $_POST['book_id'];
        $bName = $_POST['book_name'];
        $cName = $_POST['book_category'];
    
        // Sanitize user input to prevent SQL injection
        $cName = $conn->real_escape_string($cName);
    
        // Fetch the category_id based on the category_name
        $sql = "SELECT category_id FROM bookcategory WHERE category_name = '$cName'";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cId = $row['category_id'];
    
            // Update the book details in the book table
            $sql = "UPDATE book SET book_name='$bName', category_id='$cId' WHERE book_id='$bId'";
    
            if ($conn->query($sql)) {
                $_SESSION['message'] = "Record has been updated";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "Error: " . $conn->error;
                $_SESSION['msg_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Category not found";
            $_SESSION['msg_type'] = "danger";
        }

        header("Location: books-registration.php");
    }
    

?>