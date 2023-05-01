<?php
include "../config.php";
session_start();

if (isset($_POST['edit-form-submit'])) {
    print_r($_POST);
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user = $_SESSION['username'];

    $sql1 = "UPDATE `admins` SET `username`='$username',`email`='$email',`name`='$name' WHERE username='{$user}';";
    $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

    header("location:   ./editProfile.php?username={$_SESSION['username']}");

}

?>