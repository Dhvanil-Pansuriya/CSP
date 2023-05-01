<?php
include "../config.php";
$username = $_GET['username'];

echo $sql = "DELETE FROM `users` WHERE username='{$username}'";
$result = mysqli_query($conn, $sql) or die("Query Failed.");

header("location: ./manageUsers.php");
?>