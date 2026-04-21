<?php
include '../config/connect.php';

$name = $_POST['name'];
$skill = $_POST['skill'];

mysqli_query($conn, "INSERT INTO skill (name, skill) VALUES ('$name', '$skill')");

header("Location: ../admin.php");