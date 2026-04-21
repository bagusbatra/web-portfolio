<?php
include '../config/connect.php';

$id       = $_POST['id'];
$tittle    = $_POST['tittle'];
$issuer   = $_POST['issuer'];
$year     = $_POST['year'];
$category = $_POST['category'];
$desc     = $_POST['desc'];

$img = $_FILES['img']['name'];
$tmp = $_FILES['img']['tmp_name'];

$folder = "../assets/uploads/certified/";

if ($img != '') {

    $nama_file = time() . '_' . $img;
    move_uploaded_file($tmp, $folder . $nama_file);

    $query = "UPDATE certified SET 
        tittle='$tittle',
        issuer='$issuer',
        img='$nama_file',
        year='$year',
        `desc`='$desc',
        category='$category',
        updated_at=NOW()
        WHERE id='$id'";

} else {

    $query = "UPDATE certified SET 
        tittle='$tittle',
        issuer='$issuer',
        year='$year',
        `desc`='$desc',
        category='$category',
        updated_at=NOW()
        WHERE id='$id'";
}

mysqli_query($conn, $query);

header("Location: ../admin.php?msg=updated");