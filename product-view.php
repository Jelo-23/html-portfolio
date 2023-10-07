<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  // $_SESSION['table'] = 'product'; // This is the proper way of storing data in our table. 
                                // We insert data in our "table key" session with the value of "users table" that we assigned.
                                // Note: 'users' value is derived from our database. 'users' is our table name.
  // Get all products.
  $show_table = 'product';
  $products = include('database/show.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Products - Inventory Management System</title>
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
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Descrition</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($products as $index => $product){?>
                        <tr>
                          <td><?= $index + 1 ?></td>
                          <td>
                            <img class="productImages" src="uploads/products/<?= $product['img'] ?>" alt="image">
                          </td>
                          <td class="productName"><?= $product['product_name'] ?></td>
                          <td class="description"><?= $product['description'] ?></td>
                          <td><?= $product['created_by'] ?></td>
                          <td><?= date('M d,Y @ h:i:s A', strtotime($product['created_at'])) ?></td>
                          <td><?= date('M d,Y @ h:i:s A', strtotime($product['updated_at'])) ?></td>
                          <td class="delete_update">
                            <a href="" class="updateProduct" data-pid="<?=$product['id']?>" data-bs-toggle="modal" data-bs-target="#edit-modal"><i class="fa fa-pencil"></i>
                              Edit
                            </a>
                            <a href="" class="deleteProduct" data-name="<?= $product['product_name'] ?>" data-pid="<?=$product['id']?>"><i class="fa fa-trash"></i>Delete</a>
                          </td>
                        </tr> 
                      <?php } ?>
                    </tbody>
                </table>
                  <p class="userCount"><?= count($product) ?> Products</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include('partials/app-scripts.php'); ?>                     

<script>
  function script(){
    this.initialize = () => {
      this.registerEvents();
    }

    this.registerEvents = () => { // They received an events so we have to use "this" keyword.
      document.addEventListener('click', (e) => {
        targetElement = e.target;
        myClassList = targetElement.classList;
        
        if(myClassList.contains('deleteProduct')){
          e.preventDefault();

          pId = targetElement.dataset.pid;
          pName = targetElement.dataset.name;
          
          BootstrapDialog.confirm({
            type: BootstrapDialog.TYPE_DANGER,
            title: 'Delete Product',
            message: 'Are you sure you want to delete <strong>' + pName + '</strong>?',
            callback: (isDelete) => { // if the user click ok
              if(isDelete){
                $.ajax({ // ajax will help us to connect with our local server. It helps to fetch data.
                method: 'POST',
                data:{
                  pId: pId,
                  table: 'product'
                },
                url: 'database/delete.php',
                dataType: 'json',
                success: (data) => {
                  message = data.success ? pName + ' successfully deleted!' : 'Error processing request';

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

      });
    }
  }
  script = new script;
  script.initialize();
</script>

</html>