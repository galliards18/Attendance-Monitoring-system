<?php
include 'config.php';

$student_id = $_GET['student_id'];

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 0');

$sql = "DELETE FROM student_registration WHERE student_id=$student_id";

if (mysqli_query($conn, $sql)) {
    header('location: Index.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 1');

mysqli_close($conn);
?>
