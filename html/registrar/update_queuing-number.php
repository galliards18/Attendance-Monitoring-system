<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['onServeQueueNumber'] = $_POST['queueNumber'];
    echo "On-serve queue number updated successfully.";
}
?>
