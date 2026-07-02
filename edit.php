<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include 'config.php';
include 'security.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    header("Location:index.php");
    exit();
}

$id = (int)$_GET['id'];

/* Fetch the post */
$stmt = $conn->prepare("SELECT * FROM posts WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0)
{
    die("Post not found.");
}

$post = $result->fetch_assoc();

/* Allow only owner or admin */
if(
    $_SESSION['role'] != "admin" &&
    $_SESSION['user_id'] != $post['user_id']
)
{
    die("Access Denied.");
}

if(isset($_POST['update']))
{
    $title = cleanInput($_POST['title']);
    $content = cleanInput($_POST['content']);

    if(empty($title) || empty($content))
    {
        echo "<script>alert('All fields are required.');</script>";
    }
    elseif(strlen($title) < 3)
    {
        echo "<script>alert('Title must be at least 3 characters.');</script>";
    }
    elseif(strlen($content) < 10)
    {
        echo "<script>alert('Content must be at least 10 characters.');</script>";
    }
    else
    {
        $update = $conn->prepare(
            "UPDATE posts
             SET title=?, content=?
             WHERE id=?"
        );

        $update->bind_param(
            "ssi",
            $title,
            $content,
            $id
        );

        if($update->execute())
        {
            echo "<script>
            alert('Post Updated Successfully');
            window.location='index.php';
            </script>";
        }
        else
        {
            echo "<script>alert('Update Failed');</script>";
        }

        $update->close();
    }
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Edit Post</title>

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

✏️ Edit Post

</h2>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Title

</label>

<input
type="text"
name="title"
class="form-control"
required
maxlength="255"
minlength="3"
value="<?php echo htmlspecialchars($post['title']); ?>">

</div>

<div class="mb-4">

<label class="form-label">

Content

</label>

<textarea
name="content"
rows="8"
class="form-control"
required
minlength="10"><?php echo htmlspecialchars($post['content']); ?></textarea>

</div>

<button
type="submit"
name="update"
class="btn btn-primary w-100">

💾 Update Post

</button>

</form>

<div class="text-center mt-3">

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