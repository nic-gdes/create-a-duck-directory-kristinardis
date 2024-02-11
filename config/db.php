<?php

$conn = mysqli_connect("db:3306","root","root","db");
if(mysqli_connect_errno()) {
    echo "Database error: " . mysqli_connect_error();
    exit();
}