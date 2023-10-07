<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  $_SESSION['table'] = 'users'; // This is the proper way of storing data in our table. 
                                // We insert data in our "table key" session with the value of "users table" that we assigned.
                                // Note: 'users' value is derived from our database. 'users' is our table name.
  $_SESSION['redirect_to'] = 'users-add.php';
  $user = $_SESSION['user'];
  $users = include('database/show.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Users - Inventory Management System</title>
  <?php include('partials/app-header-scripts.php'); ?>
  
</head>
<body>

  <div id="dashboard-main-container">
    <!-- sidebar -->
    <?php include('partials/app-sidebar.php'); ?> <!--  -->
    <!-- content -->
    <div class="dashboard-content-container" id="dashboard_content_container">
      <?php include('partials/app-topnav.php'); ?> <!--  -->
      <div class="dashboard-content">
      <div class="dashboard-content-main">
          <div class="row">
            <div class="column column-15">
              <h1 class="section_header"><i class="fa fa-plus"></i> Create User</h1>
                <div id="userAddFormContainer">
                  <form action="database/add.php" method="POST" class="appForm">
                    <div class="appFormInputContainer">
                      <label for="first_name">First Name</label>
                      <input type="text" class="appFormInput" id="first_name" name="first_name">
                    </div>
                    <div class="appFormInputContainer">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="appFormInput" id="last_name" name="last_name">
                    </div>
                    <div class="appFormInputContainer">
                      <label for="email">Email</label>
                      <input type="text" class="appFormInput" id="email" name="email">
                    </div>
                    <div class="appFormInputContainer">
                      <label for="password">Password</label>
                      <input type="password" class="appFormInput" id="password" name="password">
                    </div>
                    <!-- <input type="hidden" name="table" value="users"> This is not advisable -->
                    <button class="appBtn"><i class="fa-solid fa-plus"></i> Add User</button>
                  </form>
                  <?php if(isset($_SESSION['response'])){
                      $response_message = $_SESSION['response']['message'];
                      $is_success = $_SESSION['response']['success'];
                    } 
                  ?>
                    <div class="responseMessage">
                      <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'  ?>">
                        <?= $response_message ?>
                      </p>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="form-group">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Update</h3> <h5>Angelo Perico</h5>
            <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
          </div>
          <div class="modal-body">
            <label for="#modal-firstName" class="form-label"></label>
            <input type="text" class="form-control" id="modal-firstName"> 
            <label for="#modal-lastName" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="modal-lastName">
            <label for="#modal-email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="modal-email">
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Update</button>
            <button class="btn btn-secondary">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</body>
  <?php include('partials/app-scripts.php'); ?>

</html>