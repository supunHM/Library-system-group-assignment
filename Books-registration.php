<?php 
require_once("db-connection.php");
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Books Registration</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Book Registration Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="mb-0">Book Registration</h3>
                    
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="book_name">Book ID</label>
                            <input type="text" id="book_id" name="book_id" class="form-control" placeholder="Enter book ID (e.g., B001)"  value="" required>
                        </div>
                        <div class="form-group">
                            <label for="book_name">Book Name</label>
                            <input type="text" id="book_name" name="book_name" class="form-control" placeholder="Enter book name"  value="" required>
                        </div>
                        <div class="form-group">
                            <label for="book_category">Book Category</label>
                               

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <!-- Book Display Table -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3 class="mb-0">Book Records</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Book Name</th>
                                <th>Book Category</th>
                                <th>Actions</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fetch and display book records dynamically here -->
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
