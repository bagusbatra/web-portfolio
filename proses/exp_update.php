<?php
include '../config/connect.php';

$id = $_POST['id'];

$position = mysqli_real_escape_string($conn, $_POST['position']);
$company = mysqli_real_escape_string($conn, $_POST['company']);
$start = $_POST['start_year'];
$jobdesk = mysqli_real_escape_string($conn, $_POST['jobdesk']);

// FIX NULL
$end = !empty($_POST['end_year']) ? "'".$_POST['end_year']."'" : "NULL";

$query = "UPDATE experience SET 
position='$position',
company='$company',
start_year='$start',
end_year=$end,
jobdesk='$jobdesk'
WHERE id='$id'";

if(mysqli_query($conn, $query)){
    header("Location: ../admin.php");
} else {
    echo "Error: " . mysqli_error($conn);
}