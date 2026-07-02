<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow-lg border-0 rounded-4">

<div class="card-body p-5">

<div class="row align-items-center">

<div class="col-lg-8">

<h1 class="fw-bold mb-3">

Welcome,
<?php echo htmlspecialchars($_SESSION['user']); ?>

<?php

if($_SESSION['role']=="admin")
{
    echo "<span class='badge bg-danger ms-2'>ADMIN</span>";
}
else
{
    echo "<span class='badge bg-primary ms-2'>EDITOR</span>";
}

?>

</h1>

<p class="text-muted fs-5">

Manage your blog posts from one place.

</p>

<hr>

<div class="row mt-4">

<div class="col-md-4 mb-3">

<a
href="create.php"
class="btn btn-success w-100 btn-lg">

➕ Create Post

</a>

</div>

<div class="col-md-4 mb-3">

<a
href="index.php"
class="btn btn-primary w-100 btn-lg">

📄 View Posts

</a>

</div>

<div class="col-md-4 mb-3">

<a
href="logout.php"
class="btn btn-danger w-100 btn-lg">

🚪 Logout

</a>

</div>

</div>

<?php

if($_SESSION['role']=="admin")
{

?>

<div class="alert alert-danger mt-4">

<h4 class="mb-2">

🛡 Administrator Panel

</h4>

<p>

You have full access to the application.

</p>

<ul>

<li>✅ Create Posts</li>

<li>✅ Edit Any Post</li>

<li>✅ Delete Any Post</li>

<li>✅ Manage Editors</li>

<li>✅ Full Database Access</li>

</ul>

</div>

<?php

}
else
{

?>

<div class="alert alert-primary mt-4">

<h4 class="mb-2">

👤 Editor Panel

</h4>

<p>

You can manage only your own posts.

</p>

<ul>

<li>✅ Create Posts</li>

<li>✅ Edit Your Posts</li>

<li>✅ Delete Your Posts</li>

<li>❌ Cannot Manage Users</li>

<li>❌ Cannot Delete Other Users' Posts</li>

</ul>

</div>

<?php

}

?>

</div>

<div class="col-lg-4 text-center">

<?php

if($_SESSION['role']=="admin")
{

?>

<img
src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
width="220">

<?php

}
else

{

?>

<img
src="https://cdn-icons-png.flaticon.com/512/4140/4140048.png"
width="220">

<?php

}

?>

</div>

</div>

</div>

</div>

</div>

</body>

</html>