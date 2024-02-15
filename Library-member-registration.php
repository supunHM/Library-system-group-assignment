<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Form</title>
</head>
<body>
<div class="container">
        <h2 style="text-align: center;">Library member registration</h2>
        <form action="Library-member-registration.php" method="post" onsubmit="return validateEmail() && validateMemberID()">
            <label for="member_id">Member ID:</label>
            <input type="text" id="member_id" name="member_id" pattern="M[0-9]{3}"
                title="Enter a valid Member ID (e.g., M001)" required
                value="<?php echo isset($_GET['edit_member_id']) ? $_GET['edit_member_id'] : ''; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required
                value="<?php echo isset($_GET['first_name']) ? $_GET['first_name'] : ''; ?>">

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required
                value="<?php echo isset($_GET['last_name']) ? $_GET['last_name'] : ''; ?>">

            <label for="birthday">Birthday:</label>
            <input type="date" id="birthday" name="birthday" required
                value="<?php echo isset($_GET['birthday']) ? $_GET['birthday'] : ''; ?>">

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                required title="Enter a valid email address"
                value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>">

            <br><br>

            <button type="submit" name="<?php echo isset($_GET['edit_member_id']) ? 'update' : 'submit'; ?>">
                <?php echo isset($_GET['edit_member_id']) ? 'Update' : 'Submit'; ?>
            </button>
        </form>
    </div>




    






</body>
</html>