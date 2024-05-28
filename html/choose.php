<?php
session_start();
require_once "config.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if login type is selected
    if (isset($_POST["login_type"])) {
        // Student login
        if ($_POST["login_type"] == "student") {
            $email = $_POST["email"] ?? "";
            $id = $_POST["password"] ?? ""; // Change this to match the student ID field name

            $sql = "SELECT * FROM student_registration WHERE email='$email' AND id='$id'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $student = mysqli_fetch_assoc($result);
                $_SESSION["Login"] = $student["student_id"];
                header("Location: student.php");
                exit();
            } else {
                $errmsg = "Username or Password is invalid!";
            }
        }
        // Teacher login
        elseif ($_POST["login_type"] == "teacher") {
            $email = $_POST["email"] ?? "";
            $id = $_POST["password"] ?? "";

            $sql = "SELECT * FROM teacher_registration WHERE email='$email' AND id='$id'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $teacher = mysqli_fetch_assoc($result);
                $_SESSION["Login"] = $teacher["teacher_id"];
                header("Location: teacher.php");
                exit();
            } else {
                $errmsg = "Email or Password is invalid!";
            }
        }
        // Admin login
        elseif ($_POST["login_type"] == "admin") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $admin = mysqli_fetch_assoc($result);
                $_SESSION["isLogin"] = $admin["id"];
                header("Location: index.php");
                exit();
            } else {
                $errmsg = "Email or Password is invalid!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>
<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a class="app-brand-link gap-2" style="font-size: 30px;">
                                <span class=" demo text-body fw-bolder">Sign In</span>
                            </a>
                        </div>
                        <form id="formAuthentication" class="mb-3" method="POST">
                            <div class="mb-3">
                                <label for="login_type" class="form-label">Login As</label>
                                <select class="form-select" id="login_type" name="login_type">
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email" autofocus required/>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password" required/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
