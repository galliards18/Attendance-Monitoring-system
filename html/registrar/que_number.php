<?php
include '../config.php';

$sql = "SELECT MAX(Que_no) AS max_que, Date FROM registrar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $queueNumber = $row["max_que"] ?? 1000;
    $queueDate = $row["Date"] ?? '';
    
    $response = array("queueNumber" => $queueNumber, "queueDate" => $queueDate);
    echo json_encode($response);
} else {
    echo "0 results";
}

$conn->close();
?>
