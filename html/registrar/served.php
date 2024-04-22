<?php
include '../config.php';

$current_que_number = $_POST['que_no'];

$stmt = $conn->prepare("UPDATE registrar SET IsActive = 0 WHERE Que_no = ? AND IsActive = 1");
$stmt->bind_param("i", $current_que_number);

if ($stmt->execute()) {
    $result = $conn->query("SELECT Que_no FROM registrar WHERE IsActive = 1 ORDER BY Que_no ASC LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_que_number = $row["Que_no"];
        echo $next_que_number;
    } else {
        echo "No more customer";
    }
} else {
    echo "Error marking queue number as served: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
