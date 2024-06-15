<?php
session_start();

if (isset($_SESSION['onServeQueueNumber'])) {
    echo $_SESSION['onServeQueueNumber'];
} else {
    echo "N/A";
}
?>
