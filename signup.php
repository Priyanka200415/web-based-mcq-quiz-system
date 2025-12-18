<?php
include("connection.php");

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password)
              VALUES ('$username', '$email', '$hashed_password')";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error in registration!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
            background:#007BFF; color:white; border:none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Signup</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="signup">Register</button>
    </form>
    <p>Already registered? <a href="index.php">Login</a></p>
</div>

</body>
</html>
