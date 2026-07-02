<?php

include 'config.php';
include 'security.php';

if(isset($_POST['register']))
{
    $username = cleanInput($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Server-side Validation
    if(empty($username) || empty($password) || empty($confirmPassword))
    {
        echo "<script>alert('All fields are required.');</script>";
    }
    elseif(strlen($username) < 3)
    {
        echo "<script>alert('Username must be at least 3 characters.');</script>";
    }
    elseif(strlen($password) < 8)
    {
        echo "<script>alert('Password must be at least 8 characters long.');</script>";
    }
    elseif($password != $confirmPassword)
    {
        echo "<script>alert('Passwords do not match.');</script>";
    }
    else
    {
        // Check if username exists
        $check = $conn->prepare("SELECT id FROM users WHERE username=?");
        $check->bind_param("s",$username);
        $check->execute();

        $result = $check->get_result();

        if($result->num_rows > 0)
        {
            echo "<script>alert('Username already exists.');</script>";
        }
        else
        {
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $role = "editor";

            $stmt = $conn->prepare(
                "INSERT INTO users(username,password,role)
                 VALUES(?,?,?)"
            );

            $stmt->bind_param(
                "sss",
                $username,
                $hashedPassword,
                $role
            );

            if($stmt->execute())
            {
                echo "<script>
                alert('Registration Successful');
                window.location='login.php';
                </script>";
            }
            else
            {
                echo "<script>alert('Registration Failed');</script>";
            }

            $stmt->close();
        }

        $check->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Register</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-5 col-md-7">

<div class="auth-card">

<h2 class="mb-4">

Create Account ✨

</h2>

<p class="text-center text-muted mb-4">

Join and start managing your blog.

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
minlength="3"
maxlength="50">

</div>

<div class="mb-3">

<label class="form-label">

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Minimum 8 characters"
required
minlength="8">

</div>

<div class="mb-4">

<label class="form-label">

Confirm Password

</label>

<input
type="password"
name="confirm_password"
class="form-control"
placeholder="Confirm password"
required
minlength="8">

</div>

<button
type="submit"
name="register"
class="btn btn-success w-100">

Create Account

</button>

</form>

<div class="text-center mt-4">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>