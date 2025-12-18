<?php
session_start();
include("connection.php");

if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.html");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { background:black; font-family:Arial; }
        .box {
            width:350px; margin:100px auto;
            background:white; padding:25px;
            border-radius:10px;
        }
        input, button {
            width:100%; padding:10px; margin:8px 0;
        }
        button {
            background:#28a745; color:white; border:none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>
    <p>New user? <a href="signup.php">Signup</a></p>
</div>

</body>
</html>
