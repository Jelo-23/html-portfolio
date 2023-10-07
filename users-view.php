<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  $_SESSION['table'] = 'users'; // This is the proper way of storing data in our table. 
                                // We insert data in our "table key" session with the value of "users table" that we assigned.
                                // Note: 'users' value is derived from our database. 'users' is our table name.
  $user = $_SESSION['user'];
  $users = include('database/show.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Users - Inventory Management System</title>
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
            <div class="column column-12">
              <h1 class="section_header"><i class="fa fa-list"></i> List of User</h1>
              <div class="users">
                <table>
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </tr>
                    </thead> 
                    <tbody>
                      <?php foreach($users as $index => $user){?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td class="firstName"><?= $user['first_name'] ?></td>
                          <td class="lastName"><?= $user['last_name'] ?></td>
                          <td class="email"><?= $user['email'] ?></td>
                          <td><?= date('M d,Y @ h:i:s A', strtotime($user['created_at'])) ?></td>
                          <td><?= date('M d,Y @ h:i:s A', strtotime($user['updated_at'])) ?></td>
                          <td class="delete_update">
                            <a href="" class="updateUser" data-bs-toggle="modal" data-bs-target="myModal" data-user-id="<?=$user['id']?>"><i class="fa fa-pencil"></i>
                              Edit
                            </a>
                            <a href="" class="user_delete" data-user-id="<?=$user['id']?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody> 
                </table> 
                  <p class="userCount"><?= count($users) ?> Users</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <h3>UPDATE</h3>          
          </div>
          <div class="modal-body">
            <label for="#firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" class="form-control">
            <label for="#lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" class="form-control">
            <label for="#email">Email:</label>
            <input type="text" id="email" name="email" class="form-control">
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Ok</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->
</body>
<?php include('partials/app-scripts.php'); ?>                     

<script>
  function script(){
    this.initialize = () => { // They received an events so we have to use "this" keyword.
      this.registerEvents();  // They received an events so we have to use "this" keyword.
    }

    this.registerEvents = () => { // They received an events so we have to use "this" keyword.
      document.addEventListener('click', (e) => {
        targetElement = e.target;
        myClassList = targetElement.classList;
        
        if(myClassList.contains("user_delete")){
          e.preventDefault();
          userId = targetElement.dataset.userId; // user-id is the original variable name which came from "data-".
          fname = targetElement.dataset.fname;
          lname = targetElement.dataset.lname;
          fullname = `${fname} ${lname}`;

          BootstrapDialog.confirm({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Delete',
            btnOKLabel: 'Yes',
            message: 'Are you sure you want to delete <strong>' + fullname + '</strong>?',
            callback: (isDelete) => { // If the user click "ok"
              if(isDelete){
                $.ajax({
              method: 'POST',
              data:{
                pId: userId,
                table: 'users',
              },
              url: 'database/delete.php',
              dataType: 'json',
              success: (data) => {
                message = data.success ? fullname + ' successfully deleted!' : 'Error processing request';

                BootstrapDialog.alert({ // "success" property is from our "delete.php" file
                  type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                  message: message,
                  callback: () => {
                    if(data.success) location.reload();
                  }
                })
              }
            });
              }
            }
          });
        }

        if(myClassList.contains("updateUser")){
          e.preventDefault(); // Prevent from loading the page.

          // Get data
          firstName = targetElement.closest('tr').querySelector('td.firstName').innerHTML;
          lastName = targetElement.closest('tr').querySelector('td.lastName').innerHTML;
          email = targetElement.closest('tr').querySelector('td.email').innerHTML;
          userId = targetElement.dataset.userId; 
          // The closest() method starts at the element itself, then the anchestors (parent, grandparent, ...) until a match is found.



          BootstrapDialog.confirm({
            title: 'Update: ' + firstName + ' ' + lastName, 
            message: '<div>\
                      <form>\
                       <div class="form-group">\
                        <label for="firstName">First Name:</label>\
                        <input type="text" class="form-control" id="firstName" value="'+ firstName +'">\
                       </div>\
                       <div class="form-group">\
                        <label for="lastName">Last Name:</label>\
                        <input type="text" class="form-control" id="lastName" value="'+ lastName +'""> \
                       </div>\
                       <div class="form-group">\
                        <label for="emailUpdate">Email Address:</label>\
                        <input type="email" class="form-control" id="emailUpdate" value="'+ email +'""> \
                       </div>\
                      </form> \
                      </div>', // LONG METHOD: value="'+ firstName +'"
                              // SHORT METHOD: value="${firstName}"
            btnCancelLabel: 'Cancel',
            // btnOKLabel: 'Update', 
            callback: (isUpdate) => {
                if(isUpdate){ // if user click "Ok" button.
                  $.ajax({
                    method: 'POST',
                    data:{
                      user_id: userId,
                      f_name: document.getElementById('firstName').value,
                      l_name: document.getElementById('lastName').value,
                      email: document.getElementById('emailUpdate').value
                    },
                    url: 'database/update-user.php',
                    dataType: 'json',
                    success: (data) => {
                      if(data.success){ // success property is from our delete-user.php file
                        // alert(data.message); // message property is from our delete-user.php file
                        location.reload();
                      }
                      else{
                        alert(data.message);
                      }
                    }
                  });
                }
            }
          });
          
        }
      });
    }
  }

  script = new script;
  script.initialize();  
</script>
</html>