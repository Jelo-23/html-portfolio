<?php
  // start the session
  session_start();
  
  if(!isset($_SESSION['user'])) header('Location: login.php');
  // $_SESSION['table'] = 'product'; x

  // $_SESSION['redirect_to'] = 'product-order.php'; x
  // $user = $_SESSION['user']; x

  // Get all products.
  $show_table = 'product';
  $products = include('database/show.php');
  $products = json_encode($products); // convert array to string.
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
            <div class="column column-12">
              <h1 class="section_header"><i class="fa fa-plus"></i> Order Product</h1>
               <div>
                  <div class="alignRight">
                      <button class="orderBtn orderProductBtn" id="orderProductBtn">Add Another Product</button>
                   </div>
                     <div id="orderProductLists">
                        
                     </div>
                  <div class="alignRight">
                     <button class="orderBtn submitOrderProductBtn">Submit Order</button>
                  </div>
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
    let products = <?= $products ?>;
    
    function script(){
      let productOptions = '<div> \
                              <label for="product_name">PRODUCT NAME</label>\
                              <select class="productNameSelect" name="product_name" id="product_name">\
                                 <option value="">Select Product</option>\
                                 INSERTPRODUCTHERE\
                              </select>\
                           </div>';

      // let supplierHtmlTemplate = '<div class="row">
      //                            <div style="width: 50%;">
      //                               <p class="supplierName">Supplier 1</p>
      //                            </div>
      //                            <div style="width: 50%;">
      //                               <label for="quantity">Quantity</label>
      //                               <input type="number" id="quantity" name="quantity" placeholder="Enter quanity...">
      //                            </div>
      //                         </div>';
       
         this.initialize = () => {
          this.registerEvents();
          this.renderProductOptions();
         },

         this.renderProductOptions = () => {
            let optionHTML = '';
            products.forEach((product) => {
               optionHTML += '<option value="'+ product.id +'">"'+ product.product_name +'"</option>';

            });

            productOptions = productOptions.replace('INSERTPRODUCTHERE', optionHTML);
         },

         // Add new product order event
         this.registerEvents = () => {
            document.addEventListener("click", (e) => {
               targetElement = e.target;
               myClassList = targetElement.classList;

               if(targetElement.id === 'orderProductBtn'){
                  let orderProductListContainer = document.getElementById('orderProductLists');

                  orderProductLists.innerHTML += '<div class="orderProductRow">\
                                                         '+productOptions+'\
                                                      <div class="supplierRows"> </div>\
                                                   </div>'
               }
            });

            document.addEventListener("change", (e) => {
               targetElement = e.target;
               myClassList = targetElement.classList;

               if(myClassList.contains("productNameSelect")){
                  let pid = targetElement.value;

                  if(!pid.length){
                     $.get
                  }
               }
            });
         }
      }
   new script().initialize();
   </script>
</html>
<!-- 22:40 -->