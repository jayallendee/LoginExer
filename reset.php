<?php 
  session_start();
  include 'db_connection.php';
?>

<!DOCTYPE HTML>  
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebasneueregular" type="text/css">
  <style>
    .error {color: #FF0000;}
  </style>
</head>
<body>  
<div class="login">

<h2>
<?php
$usernameErr = $passwordErr = "";
$username = $password = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["password"] = $_POST["password"];



    if (empty($_SESSION["username"])) {
      $usernameErr = "Username is required";
    } else {
        $username = trim($_POST["username"]);
    } 
    
    if(empty($_SESSION["password"])) {
      $passwordErr = "Password is required";
    } else {
      $password = trim($_POST["password"]);
    } 

    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "UPDATE user SET password ='$password' WHERE username = '$username' ";
      $result = mysqli_query($db,$sql) or die(mysqli_error($db));
      $active = isset($row['active']);

    if($usernameErr != true && $passwordErr != true) {
      $_SESSION['reset_password'] = "username";
      header("Location: success_reset.php");
    }

  }

?>
</h2>

<h1>LOG-IN</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  <h2>Username: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* </h2><?php echo $usernameErr;?></span>
  
  
  <h2>New Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* </h2><?php echo $passwordErr;?></span>
  </h2>

  <input type="submit" step="any" name="submit" min="0" max="100" value="Reset">  
  <br>
  <br>

</form>
</div>

</body>
</html>