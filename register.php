<?php
include 'config.php';

if(isset($_POST['register'])){

    $username = $_POST['username'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $check = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE username='$username'"
);

if(mysqli_num_rows($check) > 0){

    echo "<script>
            alert('Username already exists!');
          </script>";

}
else{

    $query = "INSERT INTO users(username,password)
              VALUES('$username','$password')";

    mysqli_query($conn,$query);

    header("Location: login.php");
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <form method="POST">

        <h2>Register</h2>

        <input type="text"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               name="password"
               placeholder="Password"
               required>

        <button name="register">
            Register
        </button>

        <br><br>

        <a href="login.php">
            Already have an account? Login
        </a>

    </form>

</div>

</body>
</html>