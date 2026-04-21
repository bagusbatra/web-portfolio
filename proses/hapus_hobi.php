<?php
include '../config/connect.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM hobi WHERE id = '$id'");

header("Location: ../admin.php");