<?php
  include("loginServer.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" type="text/css" href="css/style-index.css">
</head>
<body>
  <div class="container">
    <form action="" method="post">
      <h1>Admin Login</h1>
      <div class="form-content">
        <input id="user-name" name="user-name" placeholder="user name" type="text"/>
        <input id="password" name="password" placeholder="password" type="password"/>
        <br/>
        <input class="button" type ="submit" name="button" value="Login"><br/>
        <div class="signup-message" style="color: red;">
          <?php echo $error ?>
        </div>
      </div>
    </form>
</div>
</body>
</html>