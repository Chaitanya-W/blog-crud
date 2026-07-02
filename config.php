<?php

$host = "localhost";
$user = "root";
$password = "1234567890";
$database = "blog";
$port = 3306;

$conn = new mysqli(
    $host,
    $user,
    $password,
    $database,
    $port
);

if($conn->connect_error)
{
    die("Database Connection Failed.");
}

$conn->set_charset("utf8mb4");

?>