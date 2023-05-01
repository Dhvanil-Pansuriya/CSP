<?php
include "../config.php";

session_start();

$path = pathinfo($_FILES['user_avatar']['name']);
$filename = $_SESSION['username'] . "." . $path['extension'];

$moveFile = move_uploaded_file($_FILES['user_avatar']['tmp_name'], "../images/user_avatars/{$filename}");

$sql = "UPDATE `users` SET `user_avatar`='${filename}' WHERE username='{$_SESSION['username']}'";
$result = mysqli_query($conn, $sql) or die("Query Failed");

if ($result) {
    header("location: ./editProfile.php?username={$_SESSION['username']}");
}

?>