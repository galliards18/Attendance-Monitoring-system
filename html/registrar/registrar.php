<?php
session_start();

if (!isset($_SESSION['isLogin'])) {
    header('location: ../choose.php');
    exit;
}

require_once('../config.php');

function sanitize($data) {
    return htmlspecialchars(strip_tags($data));
}

if ($_SERVER['REQUEST_METHOD'] == "GET"){
    $Student_IDFilter = isset($_GET['student_id']) ? sanitize($_GET['student_id']) : '';
    
    $sqlquery = "SELECT * FROM registrar WHERE 1";

    if (!empty($student_idFilter)) {
        $sqlquery .= " AND student_id LIKE '%$Student_IDFilter%'";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Que_no']) && isset($_POST['student_id']) && isset($_POST['student_fullname'])) {

    $queue_number = intval($_POST['Que_no']);
    if ($queue_number < 1001 || $queue_number > 1999) {
        die("Invalid queue number.");
    }
    
    $student_id = $_POST['student_id'];
    $student_fullname = $_POST['student_fullname'];
    

    $sql = "INSERT INTO registrar (queue_date, queue_number, student_id, student_fullname) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $queue_date = date("Y-m-d");
    
    $stmt->bind_param("siss", $queue_date, $queue_number, $student_id, $student_fullname);
    
    if ($stmt->execute()) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
    
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">
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
    <script>
        function fetchNextQueueNumber() {
            var currentDate = new Date().toISOString().slice(0, 10);

            $.ajax({
                url: 'que_number.php',
                type: 'GET',
                success: function(response) {
                    var responseData = JSON.parse(response);
                    var nextQueueNumber = responseData.queueNumber;
                    var queueDate = responseData.queueDate;

                    if (currentDate !== queueDate) {
                        nextQueueNumber = 1001;
                    }

                    document.getElementById('queueNumber').innerText = nextQueueNumber;

                    updateOnServeQueueNumber(nextQueueNumber);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateOnServeQueueNumber(queueNumber) {
            $.ajax({
                url: 'update_queuing_number.php',
                type: 'POST',
                data: { queueNumber: queueNumber },
                success: function(response) {
                    console.log('On-serve queue number updated successfully.');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to update on-serve queue number:', xhr.responseText);
                }
            });
        }

        function incrementQueueNumber() {
            var currentNumber = parseInt(document.getElementById('queueNumber').innerText);
            if (currentNumber >= 1999) {
                document.getElementById('queueNumber').innerText = 1001;
            } else {
                document.getElementById('queueNumber').innerText = currentNumber + 1;
            }
        }

        function decrementQueueNumber() {
            var currentNumber = parseInt(document.getElementById('queueNumber').innerText);
            if (currentNumber <= 1001) {
                document.getElementById('queueNumber').innerText = 0999;
            } else {
                document.getElementById('queueNumber').innerText = currentNumber - 1;
            }
        }

        function confirmServed() {
            var que_no = document.getElementById('queueNumber').innerText;
            $.ajax({
                url: 'served.php',
                type: 'POST',
                data: { que_no: que_no },
                success: function(response) {
                    document.getElementById('queueNumber').innerText = response;
                    fetchServedQueueNumbers();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
        
        function fetchServedQueueNumbers() {
            $.ajax({
                url: 'on_served_queuing_number.php',
                type: 'GET',
                success: function(response) {
                    $('#servedQueueList').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            fetchNextQueueNumber();
            fetchServedQueueNumbers();
        });
    </script>
    <style>
      .btn {
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
      }

      .btn-primary {
          background-color: #007bff;
          color: #fff;
      }

      .btn-primary:hover {
          background-color: #0056b3;
      }

      .btn-success {
          background-color: #28a745;
          color: #fff;
      }

      .btn-success:hover {
          background-color: #218838;
      }

      .queue-number {
          font-size: 24px;
          font-weight: bold;
          margin: 0 20px;
      }

      .centered-button {
          text-align: center;
          margin-top: 20px;
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
              <a href="../index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">Student  </div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item active">
              <a href="registrar/registrar.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building"></i>
                <div data-i18n="Analytics">Queuing Students</div>
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
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Registrar Office</h5>
                          
                            <div class="container">
                              <div class="container">
                                <div class="mb-3" style="display: flex; justify-content: center; align-items: center;">
                                    <button class="btn btn-primary mr-3" onclick="decrementQueueNumber()">Previous</button>
                                    <span id="queueNumber" class="queue-number mx-3">1001</span>
                                    <button class="btn btn-primary mr-3" onclick="incrementQueueNumber()">Next</button>
                                    <div class="centered-button" style="margin-top: 10px; margin-left: 10px; padding-left: 40px;">
                                        <button class="btn btn-success" onclick="confirmServed()" style="margin-top: -10px;">Finish Serving</button>
                                    </div>
                                </div>
                              </div>

                              <table border="1" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="padding: 10px;">Queue Number</th>
                                        <th style="padding: 10px;">ID</th>
                                        <th style="padding: 10px;">Student Fullname</th>
                                        <th style="padding: 10px;">Status</th>
                                        <th style="padding: 10px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="servedQueueList">
                                    <?php
                                    $sql = "SELECT * FROM registrar";
                                    if ($result = mysqli_query($conn, $sql)) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<tr>";
                                            echo "<td style='padding: 10px;'>" . $row['Que_no'] . "</td>";
                                            echo "<td style='padding: 10px;'>" . $row['student_id'] . "</td>";
                                            echo "<td style='padding: 10px;'>" . $row['student_fullname'] . "</td>";
                                            echo "<td style='padding: 10px;'>" . $row['IsActive'] . "</td>";
                                            echo "<td><a onclick=\"return confirm('Are you sure?')\" href='delete.php?student_id=". $row['student_id'] ."'><i class='menu-icon tf-icons bx bx-trash'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://www.facebook.com/james.jeager.3" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
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
