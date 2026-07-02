<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include 'config.php';
include 'security.php';

if(isset($_POST['submit']))
{
    $title = cleanInput($_POST['title']);
    $content = cleanInput($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if(empty($title) || empty($content))
    {
        echo "<script>alert('All fields are required.');</script>";
    }
    elseif(strlen($title) < 3)
    {
        echo "<script>alert('Title must contain at least 3 characters.');</script>";
    }
    elseif(strlen($content) < 10)
    {
        echo "<script>alert('Content must contain at least 10 characters.');</script>";
    }
    else
    {
        $stmt = $conn->prepare(
            "INSERT INTO posts(title,content,user_id)
             VALUES(?,?,?)"
        );

        $stmt->bind_param(
            "ssi",
            $title,
            $content,
            $user_id
        );

        if($stmt->execute())
        {
            echo "<script>
            alert('Post Created Successfully');
            window.location='index.php';
            </script>";
        }
        else
        {
            echo "<script>alert('Something went wrong');</script>";
        }

        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Create Post</title>

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

<div class="col-lg-8">

<div class="auth-card">

<h2 class="mb-4">

Create New Post ✍️

</h2>

<p class="text-muted text-center mb-4">

Share your thoughts with everyone.

</p>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Title

</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter post title"
required
maxlength="255"
minlength="3">

</div>

<div class="mb-4">

<label class="form-label">

Content

</label>

<textarea
name="content"
rows="8"
class="form-control"
placeholder="Write something amazing..."
required
minlength="10"></textarea>

</div>

<button
type="submit"
name="submit"
class="btn btn-success w-100">

Publish Post 🚀

</button>

</form>

<div class="text-center mt-4">

<a
href="index.php"
class="btn btn-outline-secondary">

← Back to Posts

</a>

</div>

</div>

</div>

</div>

</div>

</body>

</html>