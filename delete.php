<?php

session_start();

if(!isset($_SESSION['user']))
{
    header("Location: login.php");
    exit();
}

include 'config.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id']))
{
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];

/* Fetch the post */
$stmt = $conn->prepare("SELECT user_id FROM posts WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0)
{
    die("Post not found.");
}

$post = $result->fetch_assoc();

/* Only Admin or Owner can delete */
if(
    $_SESSION['role'] != "admin" &&
    $_SESSION['user_id'] != $post['user_id']
)
{
    die("Access Denied.");
}

$stmt->close();

/* Delete Post */
$delete = $conn->prepare("DELETE FROM posts WHERE id=?");
$delete->bind_param("i",$id);

if($delete->execute())
{
    echo "<script>
    alert('Post Deleted Successfully');
    window.location='index.php';
    </script>";
}
else
{
    echo "<script>alert('Unable to delete post.');</script>";
}

$delete->close();

?>