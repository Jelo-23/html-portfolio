<?php
  // session_start();// Ignoring session_start() because a session is already active, session_start has been already used in another file.
  include('connection.php');

  $table_name = $_SESSION['table'];
  // var_dump($_SESSION);
  // die;

  $stmt = $conn->prepare("SELECT * FROM $table_name ORDER BY created_at DESC");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  return $stmt->fetchAll();
?>