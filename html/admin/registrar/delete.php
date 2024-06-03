<?php
include '../../config.php';

$student_id = $_GET['student_id'];

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 0');

$sql_check_active = "SELECT IsActive FROM registrar WHERE student_id=$student_id";
$result_check_active = mysqli_query($conn, $sql_check_active);

if ($result_check_active) {
    $row = mysqli_fetch_assoc($result_check_active);
    $is_active = $row['IsActive'];

    if ($is_active == 0) {
        $sql = "DELETE FROM registrar WHERE student_id=$student_id";
        
        if (mysqli_query($conn, $sql)) {
            header('location: registrar.php');
        } else {
            echo "<script>alert('Error deleting record: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('The queue number is still active and cannot be deleted.'); window.location.href='registrar.php';</script>";
    }
} else {
    echo "<script>alert('Error checking IsActive status: " . mysqli_error($conn) . "');</script>";
}

mysqli_query($conn, 'SET FOREIGN_KEY_CHECKS = 1');

mysqli_close($conn);
?>
