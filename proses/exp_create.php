<?php
include '../config/connect.php';

$position = $_POST['position'];
$company = $_POST['company'];
$start = $_POST['start_year'];
$end = $_POST['end_year'] ?: NULL;
$jobdesk = $_POST['jobdesk'];

mysqli_query($conn, "INSERT INTO experience 
(position, company, start_year, end_year, jobdesk) 
VALUES ('$position','$company','$start','$end','$jobdesk')");

header("Location: ../admin.php");