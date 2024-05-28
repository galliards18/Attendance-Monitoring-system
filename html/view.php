<?php
session_start();

<<<<<<< HEAD
if (!isset($_SESSION['isLogin'])) {
    header('location: choose.php');
    exit;
=======
    if (!isset($_SESSION['isLogin'])) {
        header('location: choose.php');
        exit;
    }

  require_once('config.php');

$student_id = $yearid = $subid = $grades =  "";

$student_id = $_GET['student_id'];
$subid = isset($_GET['subid']) ? $_GET['subid'] : null;

$sql = "SELECT * FROM grades WHERE student_id='$student_id' AND subid='$subid'";

if ($results = mysqli_query($conn, $sql)) {
    // Assuming you're fetching multiple rows of grades for the same student and subject
    while ($data = mysqli_fetch_assoc($results)) {
        $gradesid = $data['gradesid'];
        // Do something with the grades data
    }
>>>>>>> 4ae5e145384c09f9378cafffe78a0f78da6985c3
}


require_once('config.php');

$student_id = $yearid = $subid = $grades =  "";
$student_id = $_GET['student_id'];
$subid = isset($_GET['subid']) ? $_GET['subid'] : null;

// Fetch student information
$sql = "SELECT * FROM student_registration WHERE student_id='$student_id'";
if ($results = mysqli_query($conn, $sql)) {
    $data = mysqli_fetch_assoc($results);
    $id = $data['id'];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $address = $data['address'];
    $gender = $data['gender'];
    $email = $data['email'];
    $birthday = $data['birthday'];
    $phone = $data['phone'];
    $yearid = $data['yearid'];
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo" style=" padding: 70px;">
                    <div class="logo">
                        <img style="border-radius: 500px; box-shadow: 2px 2px 20px #00008b; margin-top: 30px; margin-bottom: 5px;" src="../assets/img/avatars/logo.png" width="100" height="100" alt="">
                        <b><p style="font-size: 20px; color: blue; text-shadow: 2px 2px 50px #00008b; padding-left: 18px;">S L S U</p></b>
                    </div>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item active">
                        <a href="index.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Analytics">Student  </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="registrar/registrar.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-building"></i>
                            <div data-i18n="Analytics">Queuing Students</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="layout-page">
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
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/avatars/user.png" alts class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="../assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"></span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y"> 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Profile Details</h5>
                                    <div class="card-body">
                                        <hr class="my-0" />
                                        <div class="card-body">
                                            <form action="#" class="form-control" id="formAccountSettings" method="POST">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="firstName" class="form-label">First Name</label>
                                                        <p class="form-control" id="firstName" autofocus><?php echo $firstname; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="lastName" class="form-label">Last Name</label>
                                                        <p class="form-control" id="lastName"><?php echo $lastname; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="id" class="form-label">Student ID</label>
                                                        <p class="form-control" id="id"><?php echo $id; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <p class="input-group-text">PH</p>
                                                            <p id="phoneNumber" class="form-control"><?php echo $phone; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="email" class="form-label">E-mail</label>
                                                        <p class="form-control" id="email"><?php echo $email; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="organization" class="form-label">Birth Date</label>
                                                        <p class="form-control" id="organization"><?php echo $birthday; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="address" class="form-label">Address</label>
                                                        <p class="form-control" id="address"><?php echo $address; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <p class="form-control" id="gender"><?php echo $gender; ?></p>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="yearid" class="form-label">Year Level</label>
                                                        <p class="form-control" id="yearid"><?php echo $yearid; ?></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="card mb-4">
    <h5 class="card-header">Grades Details</h5>
    <div class="card-body">
        <hr class="my-0" />
        <div class="card-body">
            <div class="grades-display ">
                <h2>Current Grades</h2>
                <?php
                if (isset($student_id)) {
                    $sqlquery = "SELECT subject.subname, subject.yearid, grades.grades 
                                 FROM grades 
                                 JOIN subject ON grades.subid = subject.subid 
                                 WHERE grades.student_id = '$student_id'
                                 ORDER BY subject.yearid ASC";
                    $results = mysqli_query($conn, $sqlquery);
                    if (mysqli_num_rows($results) > 0) {
                        $grades_by_year = [];
                        while ($row = mysqli_fetch_assoc($results)) {
                            $grades_by_year[$row['yearid']][] = $row;
                        }

                        foreach ($grades_by_year as $year => $grades) {
                            echo "<div class='year-section'>";
                            echo "<h3>Year Level: " . htmlspecialchars($year) . "</h3>";
                            echo "<table class='table'>";
                            echo "<thead><tr><th>Subject</th><th>Grade</th></tr></thead>";
                            echo "<tbody>";
                            $total_grade = 0;
                            $count_grade = 0;
                            foreach ($grades as $grade) {
                                echo "<tr><td>" . htmlspecialchars($grade['subname']) . "</td><td>" . htmlspecialchars($grade['grades']) . "</td></tr>";
                                $total_grade += $grade['grades'];
                                $count_grade++;
                            }
                            $average_grade = $count_grade > 0 ? $total_grade / $count_grade : 0;
                            echo "<tr><td><b>Average Grade</b></td><td>" . number_format($average_grade, 2) . "</td></tr>";
                            echo "</tbody></table>";
                            echo "</div>";
                            // Store the last year level
                            $last_year = $year;
                        }
                    } else {
                        echo "<p>No grades available for this student.</p>";
                    }
                }
                ?>
                <!-- Button to update year level -->
                <div class="text-center mt-4">
<button class="btn btn-primary" ><a href="update_grades.php">Update Grades</a></button>
                </div>
            </div>
        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
                <footer class="content-footer footer bg-footer-theme">
                </footer>
                <div class="content-backdrop fade"></div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/pages-account-settings-account.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
<<<<<<< HEAD
</body>
</html>
=======
  </body>
</html>
>>>>>>> 4ae5e145384c09f9378cafffe78a0f78da6985c3
