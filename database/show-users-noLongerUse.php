<?php
  include('connection.php');

  // $query = "SELECT * FROM users ORDER BY created_at DESC";
  // $result = $conn->query($query);
  // $rows = $result->fetch_all(MYSQLI_ASSOC);
  
  // return $rows;


  // ===== PDO

  $stmt = $conn->prepare("SELECT * FROM users ORDER BY created_at DESC");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  return $stmt->fetchAll();
?>