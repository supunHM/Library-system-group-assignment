<!DOCTYPE html>
<html lang="en">

<head>
    <title>Book-Category-Regi</title>
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
                </div>

                 <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="category_id">Category ID</label>
                            <input type="text" id="category_id" name="category_id" class="form-control" placeholder="Enter category ID (e.g., C001)" required>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter category name" required>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit" name="update">Update</button>
                       
                        <button class="btn btn-primary btn-block" type="submit" name="save">Register Category</button>
                    </form>
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
