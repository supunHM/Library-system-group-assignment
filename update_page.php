<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookID = $_POST["book_id"];
    $memberID = $_POST["member_id"];
    $borrowStatus = $_POST["borrow_status"];
    $modifiedDate = $_POST["borrower_date_modified"];

    // Validate data (you may want to implement additional validation)

    // Execute SQL query to update data in the database
    $sql = "UPDATE bookborrower SET member_id='$memberID', borrow_status='$borrowStatus', borrower_date_modified='$modifiedDate' WHERE book_id='$bookID'";

    if ($conn->query($sql) === TRUE) {
        echo "Book Borrow details updated successfully!";
    } else {
        echo "Error updating member details: " . $conn->error;
    }
}

// Fetch existing data from the database for the selected book
if (isset($_GET["book_id"])) {
    $bookID = $_GET["book_id"];

    $sql = "SELECT book.book_id, member.member_id, bookborrower.borrow_status, bookborrower.borrower_date_modified
            FROM bookborrower
            INNER JOIN book ON bookborrower.book_id = book.book_id
            INNER JOIN member ON bookborrower.member_id = member.member_id
            WHERE bookborrower.book_id = '$bookID'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingMemberID = $row["member_id"];
        $existingBorrowStatus = $row["borrow_status"];
        $existingModifiedDate = $row["borrower_date_modified"];
        $existingbookID = $row["book_id"];
    } else {
        // Handle case when no matching record found
        header("Location: view_all_borrow.php"); // Redirect to view_all_borrow.php or any other page
        exit();
    }
} else {
    // Handle case when book_id is not provided in the URL
    header("Location: view_all_borrow.php"); // Redirect to view_all_borrow.php or any other page
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Borrowed Book</title>
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

<div class="container mt-5">
    <h2>Update Borrowed Book</h2>
    <form action="" method="post">
        <!-- Existing form fields -->
        <input type="hidden" name="book_id" value="<?php echo $bookID; ?>">
        Member ID: <input type="text" name="member_id" pattern="M\d{3}" title="Please use format M001" required value="<?php echo $existingMemberID; ?>"><br><br>
        Book ID: <input type="text" name="book_id" id="book_id" pattern="B\d{3}" title="Please use format B001" required value="<?php echo $existingbookID; ?>"><br><br>
        
        Status:
        <select name="borrow_status" id="status" required>
            <option value="borrowed" <?php if ($existingBorrowStatus == 'borrowed') echo 'selected'; ?>>Borrowed</option>
            <option value="available" <?php if ($existingBorrowStatus == 'available') echo 'selected'; ?>>Available</option>
        </select>
        Date: <input type="date" name="borrower_date_modified" required value="<?php echo $existingModifiedDate; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</div>

</body>
</html>
