<?php 
  session_start();
  include 'db_connection.php';
?>

<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebasneueregular" type="text/css">
<div class="login">
<h1>SUCCESSFUL LOG-IN!</h1>
<h2>WELCOME</h2>

<h2>
<?php
      echo $_SESSION["username"];
?>
</h2>
<br>
<a href="logout.php"> <input type="submit" step="any" name="submit" min="0" max="100" value="Log-out"> </a>
<br>
<br>
</div>