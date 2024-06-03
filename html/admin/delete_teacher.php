<?php
include '../config.php';

$teacher_id = $_GET['teacher_id'];

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 0');

$sql = "DELETE FROM teacher_registration WHERE teacher_id=$teacher_id";

if (mysqli_query($conn, $sql)) {
    header('location: teacher.php');
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 1');

mysqli_close($conn);
?>
