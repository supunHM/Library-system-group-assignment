<?php
require_once('db-connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users list</title>
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
    <!-- Book Borrow Details Form -->
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h3 class="mb-0">Users List</h3>
                    
                     
        </div>
        <div class="card-body">
            <form action="userlist_process.php" method="post">
                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="text" id="userId" name="userId" class="form-control" placeholder="Enter user ID" value= "" required>
                </div>
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" name="userName" class="form-control" placeholder="Enter user name" value="" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter first name" value="" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter last name" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email address" value="" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" value="" required>
                </div>
                

                <button class="btn btn-primary btn-block" type="submit" name="update" >Update</button>
            </form>
        </div>
    </div>

    <!-- Borrow Details Table -->
    <div class="card mt-5">
        <div class="card-header text-center bg-success text-white">
            <h3 class="mb-0">Users List</h3>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Actions</th> <!-- Added column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Fetch and display borrow records dynamically here -->
                    
                    
                                <tr>
                                    <td>U001</td>
                                    <td>K_Perera</td>
                                    <td>Kamal</td>
                                    <td>Perera</td>
                                    <td>kamal@gmail.com</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="userlist.php?edit="><button class="btn btn-warning btn-sm">Edit</button></a> <!-- Update button -->
                                            <a href="userlist_process.php?delete="><button class="btn btn-danger btn-sm">Delete</button></a> <!-- Delete button -->
                                        </div>
                                    </td>
                                </tr>
                            
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
