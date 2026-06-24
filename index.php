<?php
session_start();

include 'config.php';

$limit = 3;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$start = ($page - 1) * $limit;

$search = "";

if(isset($_GET['search'])){
    $search = mysqli_real_escape_string(
        $conn,
        $_GET['search']
    );
}

$query = "
SELECT *
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
ORDER BY created_at DESC
LIMIT $start,$limit
";

$result = mysqli_query($conn,$query);

$total_query = mysqli_query(
$conn,
"
SELECT COUNT(*) as total
FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
"
);

$total_row = mysqli_fetch_assoc($total_query);

$total_pages = ceil(
$total_row['total'] / $limit
);
?>

<!DOCTYPE html>
<html>

<head>

<title>Posts</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-4">

<h1 class="fw-bold">
Posts
</h1>

<div>

<a
href="create.php"
class="btn btn-success">

New Post

</a>

<a
href="logout.php"
class="btn btn-outline-danger">

Logout

</a>

</div>

</div>

<form method="GET">

<div class="input-group mb-4">

<input
type="text"
name="search"
class="form-control"
placeholder="Search posts..."
value="<?php echo $search; ?>">

<button
class="btn btn-primary">

Search

</button>

</div>

</form>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<div class="post-card">

<h2>
<?php echo $row['title']; ?>
</h2>

<p>
<?php echo $row['content']; ?>
</p>

<div class="post-date">

<?php echo $row['created_at']; ?>

</div>

<div class="mt-3">

<a
href="edit.php?id=<?php echo $row['id']; ?>"
class="btn btn-secondary btn-sm">

Edit

</a>

<a
href="delete.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">

Delete

</a>

</div>

</div>

<?php
}
?>

<nav>

<ul class="pagination justify-content-center">

<?php
for($i=1;$i<=$total_pages;$i++)
{
?>

<li class="page-item">

<a
class="page-link"
href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">

<?php echo $i; ?>

</a>

</li>

<?php
}
?>

</ul>

</nav>

</div>

</body>
</html>