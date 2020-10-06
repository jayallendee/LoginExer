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
      
      $sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db,$sql) or die(mysqli_error($db));
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = isset($row['active']);

      $count = mysqli_num_rows($result);

    if($usernameErr != true && $passwordErr != true && $count != 1){
      echo "Your username or Password is not in the database!";
      echo "<br>";
      echo "Please try again.";
    }

    if($usernameErr != true && $passwordErr != true && $count == 1) {
      $_SESSION['login_user'] = "username";
      header("Location: success.php");
    }

  }

?>
</h2>

<h1>LOG-IN</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
  <h2>Username: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* </h2><?php echo $usernameErr;?></span>
  
  
  <h2>Password: <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* </h2><?php echo $passwordErr;?></span>
  </h2>

  <p><a href="reset.php">Forgot Password?</a></p>

  <input type="submit" step="any" name="submit" min="0" max="100" value="Log-in">  
  <br>
  <br>

</form>
</div>

</body>
</html>