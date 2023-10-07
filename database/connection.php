<?php

  // $db_server = 'localhost';
  // $db_user = 'root';
  // $db_pass = '';
  // $db_name = 'inventory';

  // try{
  //     $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
  //   }
  //   catch(Exception $e){
  //     $errorMessage = $e->getMessage();
  //   } 


 // ========================== (PDO) Other way of creating connection in our database.
  $servername = 'localhost';
  $username = 'root';
  $password = '';

  try {
    $conn = new PDO("mysql:host=$servername;dbname=inventory", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

  } catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
?>