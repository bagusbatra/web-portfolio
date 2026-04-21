<?php
include '../config/connect.php';

$id = $_GET['id'];

// ambil gambar dulu
$data = mysqli_query($conn, "SELECT img FROM certified WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if ($row['img'] != '') {
    unlink("../assets/uploads/certified/" . $row['img']);
}

// hapus data
mysqli_query($conn, "DELETE FROM certified WHERE id='$id'");

header("Location: ../admin.php?msg=deleted");