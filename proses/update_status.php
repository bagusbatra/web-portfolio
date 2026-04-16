<?php
include '../config/connect.php';

$status_id = $_POST['status_id'];

if ($status_id) {
    mysqli_query($conn, "INSERT INTO user_status (status_id) VALUES ('$status_id')");
}

header("Location: ../admin.php");
exit;
?>