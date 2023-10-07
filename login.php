<?php
//Session start...
session_start();

if(isset($_SESSION['user'])) header('location: dashboard.php');
// ==> msqli
$errorMessage = '';
if($_POST){  
    include('database/connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sqlQuery = 'SELECT * FROM users WHERE users.email = "'.$username.'" AND users.password = "'.$password.'"'; // The condition has been wrote in this line of code.
    // $result = $conn -> query($sqlQuery);
    
    // if(mysqli_num_rows($result) > 0){
    //   $user = $result -> fetch_assoc(); // This will get the value/information for every row. This is where all begins.
    //   $_SESSION['user'] = $user; // we store the users value/information in a session.
    //                               // $_SESSION['user'] is our key.
      
    //   header('Location: dashboard.php');
    // }
    // else{
    //   $errorMessage = "Invalid username/password...";
    // } 
    
    // ================ (PDO) Other way of creating connection in our databse.

    // $result = mysqli_query($conn, $query);
    $stmt = $conn->prepare($sqlQuery); 
    $stmt ->execute();

    if($stmt->rowCount() > 0){
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $user = $stmt->fetchAll()[0];
      $_SESSION['user'] = $user;

      header('Location: dashboard.php');
    }
    else{
      $errorMessage = "Invalid username/password...";
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>IMS Login - Inventory Management System</title>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body id="loginBody">
      <?php if(!empty($errorMessage)){ ?>
        <div id="errorMessage">
          <span class="error_text">Error</span>: <p><?= $errorMessage; ?> </p>
        </div>
      <?php } ?>

    <div class="container">
      <div class="loginHeader">
        <h1>IMS</h1>
        <p>Inventory Management System</p>
      </div>
      <div class="loginBody">
        <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
          <div class="loginInputContainer">
            <label for="">Username</label>
            <input type="text" placeholder="username" name="username">
          </div>
          <div class="loginInputContainer">
            <label for="">Password</label>
            <input type="password" placeholder="password" name="password">
          </div>
          <div class="loginButtonContainer">
            <button>Log In</button>
          </div>
        </form>
      </div>
      </div>
    </div>
  </body>
</html>