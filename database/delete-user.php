<?php
  $data = $_POST;
  $user_id = (int) $data['user_id'];
  $firstName = $data['f_name'];
  $lastName = $data['l_name'];

  try {
    include('connection.php');
    $query = "DELETE FROM $table_name WHERE id={$user_id}";
    $result = $conn -> query($query);


    echo json_encode([
      'success' => true,
      'message' => $firstName.' '.$lastName. ' successfully deleted!'
    ]);

  } 
  catch (Exception $th) {
    echo json_encode([
      'success' => false,
      'message' => "Error processing!"
    ]);
  }
?>