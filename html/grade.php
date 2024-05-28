<?php
session_start();

if (!isset($_SESSION["Login"])) {
    header("location: choose.php");
    exit();
}
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize inputs
    $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);
    $subid = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $grades = mysqli_real_escape_string($conn, $_POST["grades"]); // Update here

    // Check if $grades is a valid decimal number
    if (!is_numeric($grades) || !preg_match('/^\d+(\.\d+)?$/', $grades)) {
        echo "Invalid input for grades. Please enter a valid decimal number.";
        exit();
    }

    // Check if record already exists for the student ID and subid
    $sqlquery = "SELECT * FROM grades WHERE student_id = '$student_id' AND subid = '$subid'";
    $results = mysqli_query($conn, $sqlquery);
    if (mysqli_num_rows($results) > 0) {
        // Update existing record
        $sqlquery = "UPDATE grades SET grades='$grades' WHERE student_id = '$student_id' AND subid = '$subid'";
    } else {
        // Insert new record
        $sqlquery = "INSERT INTO grades (student_id, subid, grades) VALUES ('$student_id', '$subid', '$grades')";
    }

    // Execute query
    if (mysqli_query($conn, $sqlquery)) {
        header("Location: {$_SERVER["PHP_SELF"]}?student_id=$student_id");
        exit();
    } else {
        echo "Error updating/inserting record: " . mysqli_error($conn);
    }
}

$student_id = "";
$grades = "";

if (isset($_GET["student_id"])) {
    // Retrieve and sanitize ID
    $student_id = mysqli_real_escape_string($conn, $_GET["student_id"]);

    // Prepare select query
    $sqlquery = "SELECT * FROM grades WHERE student_id = '$student_id'";

    // Execute query
    $results = mysqli_query($conn, $sqlquery);
    if ($results) {
        $data = mysqli_fetch_assoc($results);
        if ($data) {
            $subid = $data["subid"];
            $grades = $data["grades"];
        }
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Grades</title>
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
    <style>
        .card-header-design {
            color: #fff;
            margin-left: 400px;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
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
                    <li class="menu-item">
                        <a href="list_student.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-add-to-queue"></i>
                            <div data-i18n="Analytics">Student</div>
                        </a>
                    </li>
            </aside>
            <div class="layout-page">
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
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/avatars/user.png" alts class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="student.php">
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
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Grades Details</h5>
                                    <div class="card-body">
                                        <hr class="my-0" />
                                        <div class="card-body">
                                            <div class="container">
                                                <h1>Update Grades</h1>
                                                <form action="#" method="post" class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="subject">Subject:</label>
                                                        <select class="form-select" id="subject" name="product_name" required>
                                                            <?php
                                                            $sql = "SELECT yearlvl.yearid, subject.subid, subject.subname 
                                                                FROM student_registration 
                                                                INNER JOIN yearlvl ON student_registration.yearid = yearlvl.yearid
                                                                INNER JOIN subject ON yearlvl.yearid = subject.yearid
                                                                WHERE student_registration.student_id = $student_id";
                                                            $result = mysqli_query(
                                                                $conn,
                                                                $sql
                                                            );

                                                            if (
                                                                mysqli_num_rows(
                                                                    $result
                                                                ) > 0
                                                            ) {
                                                                while (
                                                                    $row = mysqli_fetch_assoc(
                                                                        $result
                                                                    )
                                                                ) {
                                                                    echo "<option value='" .
                                                                        $row[
                                                                            "subid"
                                                                        ] .
                                                                        "'>" .
                                                                        $row[
                                                                            "subname"
                                                                        ] .
                                                                        "</option>";
                                                                }
                                                            } else {
                                                                echo "<option value=''>No subjects available</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="grades">Grades:</label>
                                                        <input class="form-control" type="text" id="grades" name="grades" value="<?php echo $grades; ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                                    </div>
                                                    <input class="btn btn-primary" type="submit" value="Update">
                                                </form>
                                                <div class="grades-display mb-3">
                                                      <h2>Current Grades</h2>
                                                      <?php if (
                                                          isset($student_id)
                                                      ) {
                                                          $sqlquery = "SELECT subject.subname, subject.yearid, grades.grades 
                                                                       FROM grades 
                                                                       JOIN subject ON grades.subid = subject.subid 
                                                                       WHERE grades.student_id = '$student_id'
                                                                       ORDER BY subject.yearid ASC"; // Order by year level
                                                          $results = mysqli_query(
                                                              $conn,
                                                              $sqlquery
                                                          );
                                                          if (
                                                              mysqli_num_rows(
                                                                  $results
                                                              ) > 0
                                                          ) {
                                                              $currentYear = null;
                                                              while (
                                                                  $row = mysqli_fetch_assoc(
                                                                      $results
                                                                  )
                                                              ) {
                                                                  if (
                                                                      $currentYear !==
                                                                      $row[
                                                                          "yearid"
                                                                      ]
                                                                  ) {
                                                                      // Start a new section for a new year
                                                                      if (
                                                                          $currentYear !==
                                                                          null
                                                                      ) {
                                                                          echo "</tbody></table>";
                                                                      }
                                                                      $currentYear =
                                                                          $row[
                                                                              "yearid"
                                                                          ];
                                                                      echo "<h3>Year {$currentYear}</h3>";
                                                                      echo "<table class='table'>";
                                                                      echo "<thead><tr><th>Subject</th><th>Grade</th></tr></thead>";
                                                                      echo "<tbody>";
                                                                  }
                                                                  echo "<tr><td>" .
                                                                      htmlspecialchars(
                                                                          $row[
                                                                              "subname"
                                                                          ]
                                                                      ) .
                                                                      "</td><td>" .
                                                                      htmlspecialchars(
                                                                          $row[
                                                                              "grades"
                                                                          ]
                                                                      ) .
                                                                      "</td></tr>";
                                                              }
                                                              // Close the last table
                                                              echo "</tbody></table>";
                                                          } else {
                                                              echo "<p>No grades available for this student.</p>";
                                                          }
                                                      } ?>
                                                  </div>
                                                <div class="mb-3">
                                                  
                                                    <a class="btn btn-danger" href="list_student.php">Back</a>
                                                
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="content-footer footer bg-footer-theme"></footer>
                    <div class="content-backdrop fade"></div>
                </div>
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
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
