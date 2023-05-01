<?php
include "../config.php";
$snippet_id = $_GET['snippet_id'];

$sql = "DELETE FROM `code_snippets` WHERE snippet_id='{$snippet_id}'";
$result = mysqli_query($conn, $sql) or die("Query Failed.");

header("location: ./manageSnippets.php");
?>