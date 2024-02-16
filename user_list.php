<?php
require_once('db-connection.php');
require_once('userlist_process.php');
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
            <?php 
                if(isset($_SESSION['message'])):
            ?>
                <div style = "display: flex; top:30px;"  class="alert alert-<?php echo $_SESSION['msg_type']?> fade show alert-dismissible" role="alert">
            <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                        unset($_SESSION['msg_type']);
            ?>
                <button type="button" class="close" data-dismiss="alert" >
                        <span area-hidden="true">&times;</span>
                </button>
                </div>
            <?php endif; ?>        
                     
        </div>
        <div class="card-body">
            <form action="userlist_process.php" method="post">
                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="text" id="userId" name="userId" class="form-control" placeholder="Enter user ID" value= "<?php echo $userId ?>" required>
                </div>
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" name="userName" class="form-control" placeholder="Enter user name" value="<?php echo $userName ?>" required>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Enter first name" value="<?php echo $firstName ?>" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Enter last name" value="<?php echo $lastName ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email address" value="<?php echo $email ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" value="<?php echo $password ?>" required>
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
                    
                    <?php 
                       
                       $sql = "SELECT * FROM user";
                       $result = $conn->query($sql);

                       if($result->num_rows>0){
                           while($row = $result->fetch_assoc()){
                             ?>

                                <tr>
                                    <td><?php echo $row['user_id']?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td><?php echo $row['first_name']?></td>
                                    <td><?php echo $row['last_name']?></td>
                                    <td><?php echo $row['email']?></td>


                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="user_list.php?edit=<?php echo $row['user_id'];?>"><button class="btn btn-warning btn-sm">Edit</button></a> <!-- Update button -->
                                            <a href="userlist_process.php?delete=<?php echo $row['user_id'];?>"><button class="btn btn-danger btn-sm">Delete</button></a> <!-- Delete button -->
                                        </div>
                                    </td>
                                </tr>

                            <?php
                                    }

                                }else{
                                    echo "0 result";
                                }
                                $conn->close();

                                   
                            ?>
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
