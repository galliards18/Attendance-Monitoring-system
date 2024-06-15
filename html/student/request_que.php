<?php
session_start();

if (!isset($_SESSION['Login'])) {
    header('location: choose.php');
    exit;
}

require_once('../config.php');

$student_id = $_SESSION['Login'];

// Function to get the next available queue number starting from 1001
function getNextQueueNumber($conn) {
    $currentDate = date("Y-m-d");
    $minQue = 1001;
    $maxQue = 1999;

    $result = $conn->query("SELECT MAX(Que_no) AS max_que FROM registrar WHERE Date = '$currentDate'");
    $row = $result->fetch_assoc();

    if ($result->num_rows > 0 && $row['max_que'] !== null) {
        $next_que = $row['max_que'] + 1;
    } else {
        $next_que = $minQue;
    }

    return min($next_que, $maxQue);
}

$sql1 = "SELECT Que_no FROM registrar WHERE IsActive = 1 AND student_id = $student_id ORDER BY Que_no ASC LIMIT 1";
$registrarQueue = "----"; // Default queue number if not found

$result1 = mysqli_query($conn, $sql1);
if ($row1 = mysqli_fetch_assoc($result1)) {
    $registrarQueue = $row1['Que_no'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_fullname = substr($_POST['student_name'] ?? '', 0, 100);
    $department = 'registrar'; // Set the department to 'registrar'

    $stmt = $conn->prepare("SELECT * FROM $department WHERE Student_ID = ? AND IsActive = 1");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('You already have an active request for this department. Please wait for your turn.'); window.location.href='request_que.php';</script>";
    } else {
        $que_no = getNextQueueNumber($conn);
        $currentDate = date("Y-m-d");

        $stmt = $conn->prepare("INSERT INTO $department (Date, Que_no, Student_ID, student_fullname, IsActive) VALUES (?, ?, ?, ?, 1)");
        $stmt->bind_param("siss", $currentDate, $que_no, $student_id, $student_fullname);

        if ($stmt->execute()) {
            echo "<script>alert('Priority number reserved successfully. Your queue number is: $que_no'); window.location.href='request_que.php';</script>";
            exit();
        } else {
            $error_message = addslashes($stmt->error); // Escape special characters
            echo "<script>alert('Error: $error_message'); window.location.href='student.php';</script>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Account</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!-- Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <script src="../../assets/js/config.js"></script>
    <style>
        .queue-numbers {
            display: flex;
            align-items: center;
        }
        .queue-item {
            margin-right: 40px;
            display: flex;
            align-items: center;
        }
        .queue-item span {
            margin-right: 20px;
        }
        .queue-number {
            color: #007bff;
            font-size: 40px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo" style=" padding: 70px;">
                    <div class="logo">
                        <img style="border-radius: 500px; box-shadow: 2px 2px 20px #00008b; margin-top: 30px; margin-bottom: 5px;" src="../../assets/img/avatars/logo.png" width="100" height="100" alt="">
                        <b>
                            <p style="font-size: 20px; color: blue; text-shadow: 2px 2px 50px #00008b; padding-left: 18px;">S L S U</p>
                        </b>
                    </div>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Profile -->
                    <li class="menu-item active">
                        <a href="request_que.php" class="menu-link">
                            <div data-i18n="Without menu">Que Number</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Layouts">Me</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="student.php" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="view_grades.php" class="menu-link">
                                    <div data-i18n="Analytics">Grades</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#.php" class="menu-link">
                                    <div data-i18n="Without menu">OTQRC</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="#.php" class="menu-link">
                                    <div data-i18n="Without menu">History Log</div>
                                </a>
                            </li>
                        </ul>
                    </li>
            </aside>
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <center>
                            <p style="font-size: 18px; padding-top: 15px;"><b>Southern Leyte State University</b></p>
                        </center>
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                  <img src="../../assets/img/avatars/profile.png" alts class="w-px-40 h-auto rounded-circle" />
                                </div>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                  <a class="dropdown-item" href="student.php">
                                    <div class="d-flex">
                                      <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                          <img src="../../assets/img/avatars/profile.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                      </div>
                                      <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"></span>
                                        <small class="text-muted">Student</small>
                                      </div>
                                    </div>
                                  </a>
                                </li>
                                <li>
                                  <a class="dropdown-item" href="../logout.php">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                  </a>
                                </li>
                              </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Queue Number</h5>
                                    <div class="card-body">
                                        <div style="border-radius: 50px;" class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="../../assets/img/avatars/profile.png" alt="user-avatar"  height="100" width="100" id="uploadedAvatar" style="border-radius: 50px;" />

                                            <div class="button-wrapper">
                                                <form id="formAccountSettings" method="POST">
                                                    
                                                    <div class="mt-2">
                                                        <button type="submit" class="btn btn-primary me-2">Reserve Queue Number</button>
                                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <h5 class="card-header">Queue Number</h5>
                                        <div class="card-body">
                                            <div class="queue-numbers">
                                                <div class="queue-item">
                                                    <span>Registrar</span>
                                                    <span class="queue-number"><?= $registrarQueue ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://www.facebook.com/james.jeager.3" target="_blank" class="footer-link fw-bolder">MeProfile</a>
                </div>
                
              </div>
            </footer>
                    </div>
                    <!-- / Content -->

                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout container -->
        </div>
        <!-- / Layout wrapper -->
        <!-- Core JS -->
        <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../../assets/vendor/libs/popper/popper.js"></script>
        <script src="../../assets/vendor/js/bootstrap.js"></script>
        <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../../assets/vendor/js/menu.js"></script>
        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>
        <!-- Page JS -->
        <script src="../../assets/js/pages-account-settings-account.js"></script>
    </div>
</body>
</html>
