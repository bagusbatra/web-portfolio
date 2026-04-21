<?php
include '../config/connect.php';

$name = $_POST['name'];
$desc = $_POST['desc'];
$birthday = $_POST['birthday'];
$address = $_POST['address'];

// cek apakah sudah ada data
$check = mysqli_query($conn, "SELECT id FROM about LIMIT 1");

if (mysqli_num_rows($check) > 0) {
    // update
    mysqli_query($conn, "
        UPDATE about SET
        name='$name',
        `desc`='$desc',
        birthday='$birthday',
        address='$address'
        LIMIT 1
    ");
} else {
    // insert pertama
    mysqli_query($conn, "
        INSERT INTO about (name, `desc`, birthday, address)
        VALUES ('$name', '$desc', '$birthday', '$address')
    ");
}

header("Location: ../admin.php");
exit;
?>