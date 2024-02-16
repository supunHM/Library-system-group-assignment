<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Borrow Book Records</title>
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

        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <a class="navbar-brand" href="dashboard.php">
        <img src="lybraryC.png" alt="OnlineImage">
    </a>
    <ul class="nav navbar-nav navbar-right">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown">Update and Delete</a>
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

<div class="container table-container">
    <h2>Library Borrow Book Records</h2>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Book ID</th>
                <th>Member Name</th>
                <th>Book Name</th>
                <th>Borrow Status</th>
                <th>Date Modified</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
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

            // Fetch member records from the database
            $sql = "SELECT book.book_id, member.first_name, book.book_name, bookborrower.borrow_status, bookborrower.borrower_date_modified
            FROM bookborrower
            INNER JOIN book ON bookborrower.book_id = book.book_id
            INNER JOIN member ON bookborrower.member_id = member.member_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["book_name"] . "</td>";
                    echo "<td>" . $row["borrow_status"] . "</td>";
                    echo "<td>" . $row["borrower_date_modified"] . "</td>";
                    echo "<td>";
                    echo "<a href='update_page.php?book_id=" . $row["book_id"] . "' class='btn btn-primary'>Edit</a> ";
                    echo "<a href='delete_book_borrow.php?book_id=" . $row["book_id"] . "' class='btn btn-danger' onclick='return confirmDelete();'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No results found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>

</body>
</html>
