<?php
 require_once('db-connection.php');
 require_once('feature3-process.php');
 require_once('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book-Category-Registration</title>
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
        <!-- Category Registration Form -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="mb-0">Category Registration</h3>
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
                     <?php endif ?>
                </div>

                 <div class="card-body">
                    <form action="feature3-process.php" method="post">
                        <div class="form-group">
                            <label for="category_id">Category ID</label>
                            <input type="text" id="category_id" name="category_id" class="form-control" placeholder="Enter category ID (e.g., C001)" value="<?php echo $cId ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter category name" value="<?php echo $cName ?>" required>
                        </div>
                        <?php if($update=="true"):  ?>
                        <button class="btn btn-primary btn-block" type="submit" name="update">Update</button>
                        <?php else:?>
                        <button class="btn btn-primary btn-block" type="submit" name="save">Register Category</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

         <!-- Category Display Table -->
         <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center bg-success text-white">
                    <h3 class="mb-0">Category Records</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th>
                                <th>Date Modified</th>
                                <th>Actions</th> <!-- Added column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                         <!-- Fetch and display category records dynamically here -->
                         <?php 
                       
                             $sql = "SELECT * FROM bookcategory";
                             $result = $conn->query($sql);

                            if($result->num_rows>0){
                                while($row = $result->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row['category_id'] ?></td>
                            <td><?php echo $row['category_Name'] ?></td>
                            <td><?php echo $row['date_modified'] ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="feature3.php?edit=<?php echo $row['category_id']; ?>"><button class="btn btn-warning btn-sm">Edit</button></a> <!-- Update button -->
                                    <a href="feature3-process.php?delete=<?php echo $row['category_id']; ?>"><button class="btn btn-danger btn-sm">Delete</button></a> <!-- Delete button -->
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

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
