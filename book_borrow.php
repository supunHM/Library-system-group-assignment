<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $borrowID = $_POST["borrow_id"];
    $bookID = $_POST["book_id"];
    $memberID = $_POST["member_id"];
    $borrowStatus = $_POST["borrow_status"];
    $modifiedDate = $_POST["borrower_date_modified"];

    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified)
            VALUES ('$borrowID', '$bookID', '$memberID', '$borrowStatus', '$modifiedDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow a Book</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa; 
        }

        .navbar-custom {
            background-color: #343a40; 
            border-bottom: 1px solid #dark; 
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
            color: #007bff; 
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
            background-color: #0056b3; 
        }
    </style>
    <script>
        function goToSearchPage() {
            var destinPage = "book_borrow_display.php";
            window.location.href = destinPage;
        }

        function goToViewAll() {
            var destinPage = "view_all_borrow.php";
            window.location.href = destinPage;
        }
    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="dashboard.php">
        <img src="lybraryC.png" alt="onlineImage">
    </a>
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown">Borrow Book</a>
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

<div class="container mt-4">
    <h2>Book Borrow</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="borrow_id">Borrow ID:</label>
            <input type="text" name="borrow_id" id="borrow_id" pattern="BR\d{3}" title="Please use format BR001" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="book_id">Book ID:</label>
            <input type="text" name="book_id" id="book_id" pattern="B\d{3}" title="Please use format B001" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="member_id">Member ID:</label>
            <input type="text" name="member_id" id="member_id" pattern="M\d{3}" title="Please use format M001" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="borrow_status">Status:</label>
            <select name="borrow_status" id="status" class="form-control" required>
                <option value="borrowed">Borrowed</option>
                <option value="available">Available</option>
            </select>
        </div>
        <div class="form-group">
            <label for="borrower_date_modified">Date:</label>
            <input type="date" name="borrower_date_modified" id="borrower_date_modified" class="form-control" required>
        </div>
        <input type="submit" value="Borrow" class="btn btn-primary">
        <input type="button" value="Search" onclick="goToSearchPage();" class="btn btn-info">
    </form>
</div>

</body>
</html>
