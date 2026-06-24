<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container py-5">

    <div class="dashboard-card">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h1>
                    Welcome, <?php echo $_SESSION['user']; ?> 👋
                </h1>

                <p class="text-muted fs-5">
                    Manage your posts and share your thoughts.
                </p>

                <div class="mt-4">

                    <a href="create.php"
                       class="btn btn-success btn-lg me-2">

                       ➕ Create Post

                    </a>

                    <a href="index.php"
                       class="btn btn-primary btn-lg me-2">

                       📄 View Posts

                    </a>

                    <a href="logout.php"
                       class="btn btn-danger btn-lg">

                       🚪 Logout

                    </a>

                </div>

            </div>

            <div class="col-md-4 text-center">

                <img
                src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                width="220">

            </div>

        </div>

    </div>

</div>

</body>
</html>