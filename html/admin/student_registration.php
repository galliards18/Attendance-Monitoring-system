<?php
session_start();

if (!isset($_SESSION["isLogin"])) {
    header("location: choose.php");
    exit();
}

require_once "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $fname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $birthday = mysqli_real_escape_string($conn, $_POST["birthday"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $yearid = mysqli_real_escape_string($conn, $_POST["yearid"]);

    // Prepare insert query
    $sql = "INSERT INTO student_registration (id, firstname, lastname, address, gender, email, birthday, phone, yearid) 
            VALUES ('$id', '$fname', '$lname', '$address', '$gender', '$email', '$birthday', '$phone', '$yearid')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Added Successfully');</script>";
        header("location: student.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
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
  data-assets-path="../../assets/"

>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Student Registration</title>

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
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
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
              <b><p style="font-size: 20px; color: blue; text-shadow: 2px 2px 50px #00008b; padding-left: 18px;">S L S U</p></b>
          </div>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
                    <li class="menu-item">
                      <a href="registrar/registrar.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-building"></i>
                        <div data-i18n="Analytics">Queuing Students</div>
                      </a>
                    </li>
                    <li class="menu-item active">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-user-circle"></i>
                            <div data-i18n="Layouts">User</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                              <a href="student.php" class="menu-link">
                                <div data-i18n="Analytics">Student</div>
                              </a>
                            </li>
                            <li class="menu-item">
                              <a href="teacher.php" class="menu-link">
                                <div data-i18n="Analytics">Teacher</div>
                              </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                            <div data-i18n="Layouts">Event</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                              <a href="#.php" class="menu-link">
                                <div data-i18n="Analytics">Create Event</div>
                              </a>
                            </li>
                            <li class="menu-item">
                              <a href="#.php" class="menu-link">
                                <div data-i18n="Analytics">Archive Event</div>
                              </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                      <a href="#.php" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i>
                        <div data-i18n="Analytics">Report</div>
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
                      <img src="../../assets/img/avatars/user.png" alts class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/user.png" alt class="w-px-40 h-auto rounded-circle" />
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
                <div class="col-lg-12 mb-12 order-12">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-lg-12">
                        <div class="card-body">
                          <div class="col-sm-12">
                                  <form action="#" class="form-control" id="formAccountSettings" method="POST">
                              <div class="row">
                                <div class="mb-3 col-md-6">
                                  <label for="firstName" class="form-label">First Name</label>
                                  <input
                                    class="form-control"
                                    type="text"
                                    id="firstName"
                                    name="firstname"
                                    placeholder="Enter Firstname"
                                    autofocus
                                    required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="lastName" class="form-label">Last Name</label>
                                  <input 
                                    class="form-control" 
                                    type="text" 
                                    name="lastname" 
                                    id="lastName" 
                                    placeholder="Enter Lastname"
                                    required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="id" class="form-label">Student ID</label>
                                  <input
                                    type="text"
                                    class="form-control"
                                    id="id"
                                    name="id"
                                    maxlength="9"
                                    placeholder="xxxxxxx-x"
                                    required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label class="form-label" for="phoneNumber">Phone Number</label>
                                  <div class="input-group input-group-merge">
                                    <span class="input-group-text">PH</span>
                                    <input
                                      type="number"
                                      id="phoneNumber"
                                      name="phone"
                                      class="form-control"
                                      placeholder="Phone Number"
                                      required
                                    />
                                  </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="email" class="form-label">E-mail</label>
                                  <input
                                    class="form-control"
                                    type="text"
                                    id="email"
                                    name="email"
                                    placeholder="john.doe@example.com"
                                    required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="organization" class="form-label">Birth Date</label>
                                  <input
                                    type="date"
                                    class="form-control"
                                    id="organization"
                                    name="birthday"
                                    required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="address" class="form-label">Address</label>
                                  <input 
                                  type="text" 
                                  class="form-control" 
                                  id="address" 
                                  name="address" 
                                  placeholder="Address" 
                                  required
                                  />
                                </div>
                                <div class="mb-3 col-md-6">
                                  <label for="currency" class="form-label" style="margin-bottom: 15px;">Gender</label>
                                  <div id="gender" name="gender" style="padding-left: 20px;" required>
                                    <input type="radio" id="female" name="gender" value="female" required>
                                    <label for="female">Female</label>
                                    <input type="radio" id="male" name="gender" value="male" required>
                                    <label for="male">Male</label>
                                  </div>
                                </div>
                              </div>
                              <div class="mb-3 col-md-6">
                                <label for="yearid" class="form-label">Login As</label>
                                <select class="form-select" id="yearid" name="yearid">
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                              
                              <div class="mt-1 p-2" style="justify-content: space-between; display: flex;">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="reset" class="btn btn-danger">Clear</button>
                              </div>
                            </form>
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
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>