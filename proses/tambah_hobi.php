<?php
include '../config/connect.php';

$name = $_POST['name'];

mysqli_query($conn, "INSERT INTO hobi (name) VALUES ('$name')");

header("Location: ../admin.php");