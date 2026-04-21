<?php
include '../config/connect.php';

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM skill WHERE id = '$id'");

header("Location: ../admin.php");