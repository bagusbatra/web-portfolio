<?php
include '../config/connect.php';

$id1 = $_POST['id1'];
$id2 = $_POST['id2'];

$job1 = $_POST['job1'];
$job2 = $_POST['job2'];

// update job 1
if ($id1) {
    mysqli_query($conn, "UPDATE job SET name='$job1' WHERE id='$id1'");
} else {
    mysqli_query($conn, "INSERT INTO job (name) VALUES ('$job1')");
}

// update job 2
if ($id2) {
    mysqli_query($conn, "UPDATE job SET name='$job2' WHERE id='$id2'");
} else {
    mysqli_query($conn, "INSERT INTO job (name) VALUES ('$job2')");
}

header("Location: ../admin.php");