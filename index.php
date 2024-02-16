<?php
session_start();    
require_once('db-connection.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hashedPassword = sha1($password);
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    if($result->num_rows >0){
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        echo "Done";
        header("Location:dashboard.php");
        exit;

    }else{
        $_SESSION['message'] = "Invalid Username or Password";
        $_SESSION['msg_type'] = "danger";
    }
}

// Check for error message
if(isset($_SESSION['message'])):
    ?>
    <div style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); z-index: 1000;" class="alert alert-<?php echo $_SESSION['msg_type']?> alert-dismissible fade show" role="alert">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['msg_type']);
        ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="position: absolute; top: 3px; left: 100px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif;?>



<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
    
</head>
<body> 
    <div class="login-container">
    <h2>Login</h2>
    <?php if(isset($error)):?>
        <p><?php echo $error;?></p>
    <?php endif; ?>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <div class="register-link">
        <a href="register.php">Create an account</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>