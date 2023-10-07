<?php
  $data = $_POST;
  $id = (int) $data['pId']; 
  $table = $data['table']; /* we have capture the data table from "product-view.php file" 
                              data:{
                              pId: pId,
                              table: 'product' 
                            } */              // this is where the "data['table]" & $data['pId'] came from.
  try {
    include('connection.php');
    $query = "DELETE FROM $table WHERE id={$id}";
    $result = $conn -> query($query);

    echo json_encode([
      'success' => true,
      // 'message' => $firstName.' '.$lastName. ' successfully deleted!'
    ]);

  } 
  catch (Exception $th) {
    echo json_encode([
      'success' => false,
      // 'message' => "Error processing!"
    ]);
  }
?>