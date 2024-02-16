<?php 
require_once("db-connection.php");
require_once("books-registration-process.php");
 
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

                            <?php
                                // Assuming $conn is your mysqli connection
                                $sql = "SELECT category_Name FROM bookcategory";
                                $result = $conn->query($sql);

                                // Check if query was successful
                                if($result) {
                                    ?>
                                    <select id="book_category" name="book_category" class="form-control" required>
                                    <?php if($update==true):?>
                                    <option value=""><?php echo $bCategory?></option>
                                    <?php else:?>
                                    <option value="">Select category</option>
                                    <?php endif;?>

                                    <?php

                                    // Fetch data and populate the dropdown
                                    while($row = $result->fetch_assoc()) {
                                        echo '<option value="'.$row['category_Name'].'">'.$row['category_Name'].'</option>';
                                    }
                                    echo '</select>';
                                } else {
                                    // Handle query error
                                    echo "Error: ".$conn->error;
                                }
                            ?>

                            

                        </div>
                            
                                <button class="btn btn-primary btn-block" type="submit" name="update">Update</button>
                           
                                <button class="btn btn-primary btn-block" type="submit" name="save">Register Category</button>
                            
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
                            <?php 
                       
                       $sql = "SELECT book.*, bookcategory.category_Name FROM book JOIN bookcategory ON book.category_id = bookcategory.category_id;";
                       $result = $conn->query($sql);

                      if($result->num_rows>0){
                      while($row = $result->fetch_assoc()){
                         ?>
                      <tr>
                          <td><?php echo $row['book_id'] ?></td>
                          <td><?php echo $row['book_name'] ?></td>
                          <td><?php echo $row['category_Name'] ?></td>
                          <td>
                              <div class="btn-group" role="group">
                                  <a href="books-registration.php?edit=<?php echo $row['book_id']; ?>"><button class="btn btn-warning btn-sm">Edit</button></a> <!-- Update button -->
                                  <a href="books-registration-process.php?delete=<?php echo $row['book_id']; ?>"><button class="btn btn-danger btn-sm">Delete</button></a> <!-- Delete button -->
                              </div>
                          </td>
                      </tr>
                      <?php
                      }
                  }else{
                      echo "o result";
                  }
                  $conn->close();
                      ?>

                            <!-- <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="books-registration.php?edit="><button class="btn btn-warning btn-sm">Edit</button></a> Update button -->
                                        <!-- <a href="books-registration-process.php?delete="><button class="btn btn-danger btn-sm">Delete</button></a>  Delete button -->
                                    <!-- </div>
                                </td>
                            </tr> --> 
                            
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
