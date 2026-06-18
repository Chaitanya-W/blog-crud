<?php
session_start();

include 'config.php';

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password,$user['password'])){

        $_SESSION['user']=$username;

        header("Location: dashboard.php");
    }
    else{
        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <form method="POST">

        <input
            type="text"
            name="username"
            placeholder="Username"
            required>

        <input
            type="password"
            name="password"
            placeholder="Password"
            required>

        <button name="login">
            Login
        </button>

    </form>

    <p>
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</div>

</body>
</html>