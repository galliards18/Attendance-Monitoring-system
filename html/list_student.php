<?php
session_start();
if (!isset($_SESSION["Login"])) {
    header("location: choose.php");
    exit();
}
require_once "config.php";
function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}
// Retrieve the year level of the logged-in teacher
$teacherId = $_SESSION["Login"];
$sqlTeacher = "SELECT yearid FROM teacher_registration WHERE teacher_id = '$teacherId'";
$resultTeacher = mysqli_query($conn, $sqlTeacher);
$teacher = mysqli_fetch_assoc($resultTeacher);
$teacherYearLevel = $teacher["yearid"];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $firstnameFilter = isset($_GET["firstname"]) ? sanitize($_GET["firstname"]) : "";
    // Adjust the SQL query to filter students by year level
    $sqlquery = "SELECT * FROM student_registration WHERE yearid = '$teacherYearLevel'";
    if (!empty($firstnameFilter)) {
        $sqlquery.= " AND firstname LIKE '%$firstnameFilter%'";
    }
    if ($result = mysqli_query($conn, $sqlquery)) {
        $totalItems = mysqli_num_rows($result);
    }
}
?>

<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"

>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard</title>

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

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo" style=" padding: 70px;">
                    <div class="logo">
                        <img style="border-radius: 500px; box-shadow: 2px 2px 20px #00008b; margin-top: 30px; margin-bottom: 5px;" src="../assets/img/avatars/logo.png" width="100" height="100" alt="">
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
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Layouts">Me</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="teacher.php" class="menu-link">
                                    <div data-i18n="Without menu">Profile</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Request -->
                    <li class="menu-item active">
                        <a href="list_student.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                            <div data-i18n="Analytics">Students</div>
                        </a>
                    </li>
            </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
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
                            <small class="text-muted">Teacher</small>
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
                <div class="col-lg-12 mb-12 order-12">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-lg-12">
                        <div class="card-body">
                          <div class="col-sm-12">
                                <form method="GET" action="" class="search-form">
                                    <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo $firstnameFilter; ?>">
                                    <center>
                                        <button type="submit" class="btn btn-primary mt-2">Search</button>
                                    </center>
                                </form>
                                <h1 class="text-center mb-4 student-enrolle"><?php echo "Year Level: " . $teacherYearLevel; ?></h1>
                                <?php if (isset($totalItems)): ?>
                                    <p class="text-center">Total Items Found: <?php echo $totalItems; ?></p>
                                <?php
endif; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>Email</th>
                                                <th>Birthday</th>
                                                <th>Phone</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $count = 1;
                                          if (mysqli_num_rows($result) > 0) {
                                              while ($row = mysqli_fetch_array($result)) {
                                                  echo "<tr>";
                                                  echo "<td>" . $row["id"] . "</td>";
                                                  echo "<td>" . $row["firstname"] . "</td>";
                                                  echo "<td>" . $row["lastname"] . "</td>";
                                                  echo "<td>" . $row["address"] . "</td>";
                                                  echo "<td>" . $row["gender"] . "</td>";
                                                  echo "<td>" . $row["email"] . "</td>";
                                                  echo "<td>" . $row["birthday"] . "</td>";
                                                  echo "<td>" . $row["phone"] . "</td>";
                                                  echo "<td class='action-icons'>";
                                                  echo "<a href='view.php?student_id=" . $row["student_id"] . "'><i class='menu-icon tf-icons bx bx-show'></i></a>";
                                                  echo "<a href='grade.php?student_id=" . $row["student_id"] . "'><i class='menu-icon tf-icons bx bx-book-content'></i></a>";
                                                  echo "<a onclick=\"return confirm('Are you sure?')\" href='Delete.php?student_id=" . $row["student_id"] . "'><i class='menu-icon tf-icons bx bx-trash'></i></a>";
                                                  echo "</td>";
                                                  echo "</tr>";
                                              }
                                          } else {
                                              echo "<tr><td colspan='9'>No records found</td></tr>";
                                          }
                                          ?>
                                                                                </tbody>
                                                                              </table>
                                                                          </div>
                                                                          <div class="text-center">
                                              <p>Total Students in Year <?php echo $teacherYearLevel; ?>:</p>
                                              <?php
                                          $sqlquery = "SELECT count(student_id) AS Total FROM student_registration WHERE yearid = '$teacherYearLevel'";
                                          if ($result = mysqli_query($conn, $sqlquery)) {
                                              while ($row = mysqli_fetch_array($result)) {
                                                  echo "<p>" . $row["Total"] . "</p>";
                                              }
                                          }
                                          ?>
                                          </div>

                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              
            </div>
            <!-- / Content -->

            <!-- Footer -->
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
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>