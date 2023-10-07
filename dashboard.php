<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  
  $user = $_SESSION['user'];
  // var_dump($_SESSION['user']);
  // die;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Inventory Management System</title>
  <script src="https://kit.fontawesome.com/11a3704436.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
  <div id="dashboard-main-container">
    <!-- sidebar -->
    <?php include('partials/app-sidebar.php'); ?>
    <!-- content -->
    <div class="dashboard-content-container" id="dashboard_content_container">
      <?php include('partials/app-topnav.php'); ?>  <!--  -->
      <div class="dashboard-content">
        <div class="dashboard-content-main" id="">
          asd
        </div>
      </div>
    </div>
  </div>
</body>
  <script src="js/script.js"></script>
</html>