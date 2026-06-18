<?php
include 'config.php';

if(isset($_POST['submit'])){

$title=$_POST['title'];
$content=$_POST['content'];

$query="INSERT INTO posts(
title,
content
)

VALUES(
'$title',
'$content'
)";

mysqli_query($conn,$query);

header("Location:index.php");
}
?>

<form method="POST">

<h2>Create Post</h2>

<input
type="text"
name="title"
placeholder="Title">

<br><br>

<textarea
name="content"
rows="5"
cols="30">
</textarea>

<br><br>

<button name="submit">
Save
</button>

</form>