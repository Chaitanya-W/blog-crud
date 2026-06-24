<?php

include 'config.php';

if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $content=$_POST['content'];

    $query="INSERT INTO posts(title,content)
            VALUES('$title','$content')";

    mysqli_query($conn,$query);

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Post</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="auth-card">

<div class="text-center mb-4">

<h2>Create New Post ✍️</h2>

<p class="text-muted">
Write something amazing today
</p>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label">
Title
</label>

<input
type="text"
name="title"
class="form-control"
placeholder="Enter post title..."
required>

</div>

<div class="mb-4">

<label class="form-label">
Content
</label>

<textarea
name="content"
rows="8"
class="form-control"
placeholder="Write your content here..."
required></textarea>

</div>

<button
name="submit"
class="btn btn-primary w-100">

💾 Save Post

</button>

</form>

<div class="text-center mt-3">

<a href="index.php"
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