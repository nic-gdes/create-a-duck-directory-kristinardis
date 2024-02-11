<?php
require_once 'config/db.php';

$sql = "SELECT image FROM ducks WHERE id=" . $_GET['id'];
$result = mysqli_query($conn, $sql);
$image = mysqli_fetch_column($result);

header("Content-type: image/jpeg");
echo $image;