<?php
session_start();

    if (!isset($_SESSION['Login'])) {
        header('location: choose.php');
        exit;
    }
    require_once('config.php');
$student_id = $yearid = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if both student_id and yearid are provided and not empty
    if (isset($_POST['student_id']) && isset($_POST['yearid']) && !empty($_POST['student_id']) && !empty($_POST['yearid'])) {
        $student_id = $_POST['student_id'];
        $yearid = $_POST['yearid'];

        // Prepare the SQL query
        $sqlquery = "UPDATE student_registration SET yearid='$yearid' WHERE student_id= $student_id";

        // Execute the query
        if (mysqli_query($conn, $sqlquery)) {
            header('location: view.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid student ID or year ID.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $student = $_SESSION['Login'];

    $sqlquery = "SELECT * FROM student_registration WHERE student_id = $student_id";

    if ($results = mysqli_query($conn, $sqlquery)) {
        $data = mysqli_fetch_assoc($results);
        $yearid = $data['yearid'];
        
    } else {
        echo "Error fetching data: " . mysqli_error($conn); 
    }
} else {
    echo "ID parameter not set or invalid.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        select, input[type="number"], input[type="text"], input[type="submit"], a {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"], a {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        input[type="submit"]:hover, a:hover {
            background-color: #45a049;
        }

        center {
            margin-top: 20px;
        }

        .btn-danger {
            background-color: #067CF9;
            color: black;
            display: inline-block;
            margin-top: -20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }

        .btn-danger:hover {
            background-color: #0754A5;
        }

    </style>
    <script>
        $(function() {
            $("#date_added").datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Year</h1>
        <form action="" method="post"> <!-- Corrected action -->
            <label for="yearid">Year:</label>
            <select id="yearid" name="yearid" required>
                <option value="1" <?php if ($yearid == 1) echo "selected"; ?>>1</option>
                <option value="2" <?php if ($yearid == 2) echo "selected"; ?>>2</option>
                <option value="3" <?php if ($yearid == 3) echo "selected"; ?>>3</option>
                <option value="4" <?php if ($yearid == 4) echo "selected"; ?>>4</option>
            </select>
            <!-- Hidden input to pass student_id -->
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="submit" value="Update">
        </form>
        <center>
            <a class="btn btn-danger mb-4" href="index.php">Back</a>
        </center>
    </div>
</body>
</html>
