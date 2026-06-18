<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "1234567890",
    "blog"
);

if(!$conn){
    die("Connection Failed");
}
?>