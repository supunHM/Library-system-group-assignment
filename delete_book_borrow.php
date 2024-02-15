<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Borrowed Book</title>
    
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Bootstrap default background color */
        }

        .navbar-custom {
            background-color: #343a40; /* Dark background color for the navbar */
            border-bottom: 1px solid #dark; /* Dark border to separate the navbar */
        }

        .navbar-brand img {
            width: auto;
            height: 60px;
        }

        .navbar-text {
            text-align: center;
            margin-left: auto;
            margin-right: 0;
            color: white;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h2 {
            color: #007bff; /* Bootstrap primary color */
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 5px;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #0056b3; /* Darker shade on hover */
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("CONFIRM?");
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="user_dashboard.php">
            <img src="lybraryC.png" alt="OnlineImage">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Delete Borrowed Book</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="book_borrow.php">Borrow a Book</a>
                    <div class="dropdown-divider"></div>
                    <!--<a class="dropdown-item" href="update_book_borrow.php">Update Borrowed Book</a>
                    <div class="dropdown-divider"></div>-->
                    <a class="dropdown-item" href="delete_book_borrow.php">Delete Borrowed Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="view_all_borrow.php">View all</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav><br>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Delete Borrowed Book</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="borrow_id">Borrow ID:</label>
                        <input type="text" name="borrow_id" pattern="BR\d{3}" title="Please use format BR001" class="form-control" required>
                    </div>
                    <input type="submit" value="Delete" name="delete" class="btn btn-danger" onclick="return confirmDelete();">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection Error: " . $conn->connect_error);
    }

    $borrowID = $_POST["borrow_id"];
    $sql = "DELETE FROM bookborrower WHERE borrow_id = '$borrowID'";
    
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "<div class='container mt-3'><div class='alert alert-success' role='alert'>Borrowed Book deleted successfully!</div></div>";
        } else {
            echo "<div class='container mt-3'><div class='alert alert-warning' role='alert'>No matching borrowed book found to delete.</div></div>";
        }
    } else {
        echo "<div class='container mt-3'><div class='alert alert-danger' role='alert'>Error deleting borrowed book: " . $conn->error . "</div></div>";
    }

    if(isset($_POST["delete"])) {
        echo '<script>window.location="view_all_borrow.php"</script>';
    }
    $conn->close();
} else {
    echo "";
}
?>
