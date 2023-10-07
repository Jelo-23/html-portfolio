<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  $_SESSION['table'] = 'product'; 

  $_SESSION['redirect_to'] = 'product-add.php';
  $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Product - Inventory Management System</title>
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
              <h1 class="section_header"><i class="fa fa-plus"></i> Create Product</h1>
                <div id="userAddFormContainer">
                  <form action="database/add.php" method="POST" class="appForm" enctype="multipart/form-data">
                    <div class="appFormInputContainer">
                      <label for="product_name">Product Name</label>
                      <input type="text" class="appFormInput" id="product_name" name="product_name" placeholder="Enter product name...">
                    </div>
                    <div class="appFormInputContainer">
                      <label for="description">Description</label>
                      <textarea class="appFormInput productTextAreaInput" id="description" name="description" placeholder="Enter product description...">
                      </textarea>
                    </div>
                    <div class="appFormInputContainer">
                      <label for="product_name">Product Image</label>
                      <input type="file" name="img">
                    </div>

                    <button class="appBtn"><i class="fa-solid fa-plus"></i> Add User</button>
                  </form>
                  <?php if(isset($_SESSION['response'])){
                      $response_message = $_SESSION['response']['message'];
                      $is_success = $_SESSION['response']['success'];
                    } 
                  ?>
                    <div class="responseMessage">
                      <p class="<?= $is_success ? 'responseMessage_success' : 'responseMessage_error'  ?>"> <!-- This are just class name to use for styling either success or error message. -->
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
<!-- 22:40 -->