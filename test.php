<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "1234567890",
    "blog",
    3306
);

if($conn){
    echo "Database Connected Successfully";
}
else{
    die(mysqli_connect_error());
}

?>