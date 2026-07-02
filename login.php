<?php
session_start();

include 'config.php';
include 'security.php';

if(isset($_POST['login']))
{
    $username = cleanInput($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password))
    {
        echo "<script>alert('Please fill all fields.');</script>";
    }
    else
    {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows == 1)
        {
            $user = $result->fetch_assoc();

            if(password_verify($password,$user['password']))
            {
                $_SESSION['user'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_id'] = $user['id'];

                header("Location: dashboard.php");
                exit();
            }
            else
            {
                echo "<script>alert('Incorrect password.');</script>";
            }
        }
        else
        {
            echo "<script>alert('User not found.');</script>";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-5 col-md-7">

<div class="auth-card">

<h2 class="mb-4">
Welcome Back 👋
</h2>

<p class="text-center text-muted mb-4">
Login to continue managing your blog.
</p>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Username
</label>

<input
type="text"
name="username"
class="form-control"
placeholder="Enter username"
required
maxlength="50">

</div>

<div class="mb-4">

<label class="form-label">
Password
</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter password"
required
minlength="8">

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

🔐 Login

</button>

</form>

<div class="text-center mt-4">

<p>

Don't have an account?

<a href="register.php">
Register
</a>

</p>

</div>

</div>

</div>

</div>

</div>

</body>

</html>