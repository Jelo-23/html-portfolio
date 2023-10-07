<?php
  $data = $_POST;
  $user_id = (int) $data['user_id'];
  $first_name = $data['f_name'];
  $last_name = $data['l_name'];
  $email = $data['email'];

  // try {
    // $query = "UPDATE users 
    //           SET users.first_name={$firstName}, users.last_name={$lastName}, users.email={$email} 
    //           WHERE id={$user_id}";
    
    $qeury = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
    include('connection.php');
    $conn->prepare($query)->execute([$first_name, $last_name, $email, $user_id]);

    echo json_encode([
      'success' => true,
      'message' => 'successfully Updated!'
    ]);

  // } 
  // catch (Exception $th) {
    echo json_encode([
      'success' => false,
      'message' => "Error processing request! {$th}" 
    ]);
  // }

  //23:42
  // vid10
?>
