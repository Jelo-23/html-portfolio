<?php
  session_start();
  // Capture the mappings
  include('table_columns.php');

  // Capture the table name
  $table_name = $_SESSION['table']; // the value of our global variable $_SESSION['table'] is "users/product table".
  $columns = $table_columns_mapping[$table_name];
  
  // Loop through the columns, this will make our program dynamic
  $db_arr = [];
  $user = $_SESSION['user'];
  foreach($columns as $column){
    if(in_array($column, ['created_at', 'updated_at'])){
      $value = date('Y-m-d H:i:s');
    }
    else if($column == 'created_by'){
      $value = $user['id'];
    }
    else if($column == 'password'){
      $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
    }
    else if($column == 'img'){
      // Upload or move the file to our directory
      $target_dir = "../uploads/products/";
      $file_data = $_FILES[$column];

      $file_name = $file_data['name'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION); // return an extension of your image.
      $file_name = 'product-' . time() .'.'. $file_ext; // Override the $file_name variable.
      // var_dump($file_names);
      // die;
      $check = getimagesize($file_data['tmp_name']); //get the image size

      if($check){
        if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){// if moving is true, the file is successfully moved to the directory then we are going to save the file name to the database.
          $value = $file_name;
        }
      }
      else{
        // 
      } 
    }
    else{
      $value = isset($_POST[$column]) ? $_POST[$column] : '';
      // the "key"      &       the "value" must have similar name between <input> and database name.
    }
    $db_arr[$column] = $value;
  }
  
  $table_properties = implode(", ", array_keys($db_arr)); // Key
  $table_palceholders = ":" . implode(", :", array_keys($db_arr));  // Value
  /* These are not actually a table values but these are placeholders  */
  // var_dump($table_properties);
  // die;


  // For users data
  // $first_name = $_POST['first_name'];
  // $last_name = $_POST['last_name'];
  // $email = $_POST['email'];
  // $password = $_POST['password'];
  // $encrypted = password_hash($password, PASSWORD_DEFAULT);

  include("connection.php");

  try{
    // $insertQuery = "INSERT INTO $table_name (first_name, last_name, email, password, created_at, updated_at)
    //                 VALUES ('".$first_name."', '".$last_name."', '".$email."', '".$encrypted."', NOW(), NOW())";
    $insertQuery = "INSERT INTO $table_name ($table_properties)
                    VALUES ($table_palceholders)";
                    
    $stmt = $conn->prepare($insertQuery); 
    $stmt->execute($db_arr);

    $response = [
      'success' => true,
      'message' => $first_name.' '.$last_name.' successfully added.'
    ];
  }
  catch(Exception $e){
    $response = [
      'success' => false, // => means key-value pairs.
      'message' => $e->getMessage()
    ];
  }

  $_SESSION['response'] = $response;
  header('location: ../' . $_SESSION['redirect_to']);
?>