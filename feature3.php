<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book-Category-Registration</title>
</head>
<body>
    
<form action="book-category-process.php" method="post">
    <div class="form-group">
        <label for="category_id">Category ID</label>
        <input type="text" id="category_id" name="category_id" class="form-control" placeholder="Enter category ID (e.g., C001)" value="<?php echo $cId ?>" required>
    </div>
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter category name" value="<?php echo $cName ?>" required>
    </div>
        <button class="btn btn-primary btn-block" type="submit" name="update">Update</button>
        <button class="btn btn-primary btn-block" type="submit" name="save">Register Category</button>
                       
</form>
</body>
</html>