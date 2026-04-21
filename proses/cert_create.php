<?php
include '../config/connect.php';

$tittle    = $_POST['tittle'];
$issuer   = $_POST['issuer'];
$year     = $_POST['year'];
$category = $_POST['category'];
$desc     = $_POST['desc'];

$img = $_FILES['img']['name'];
$tmp = $_FILES['img']['tmp_name'];

$folder = "../assets/uploads/certified/";
$nama_file = time() . '_' . $img;

if ($img != '') {
    move_uploaded_file($tmp, $folder . $nama_file);
} else {
    $nama_file = null;
}

$query = "INSERT INTO certified 
(tittle, issuer, img, year, `desc`, category, created_at, updated_at)
VALUES 
('$tittle', '$issuer', '$nama_file', '$year', '$desc', '$category', NOW(), NOW())";

mysqli_query($conn, $query);

header("Location: ../admin.php?msg=created");