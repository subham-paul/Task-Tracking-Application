<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignIn</title>
</head>

<body>
  <div class="container">
    <?php
    include_once("./assets/plugins.php");
    if (!empty($_SESSION['message'])) {
      if ($_SESSION['message'] == "wrong_credentials") {
        echo "<div class='alert alert-danger'>Invalid Username or Password.</div>";
      } else if ($_SESSION['message'] == "user_not_exists") {
        echo "<div class='alert alert-danger'>Email is not Yet Registered with Us . Please signup </div>";
      }
      unset($_SESSION['message']);
    } ?>
    <header class="modal-header">
      <h4>SignIn Page :</h4>
    </header>
    <form method="POST" action="login">
      <div class="form-group">
        <label for="email">Email-Id :</label>
        <input type="text" name="email" id="email" required class="form-control">
      </div>
      <div class="form-group">
        <label for="pass1">Password :</label>
        <input type="password" name="pass1" id="pass1" required class="form-control">
      </div>
      <div class="form-group" align="center">
        <button class="btn btn-sm btn-outline-primary">LogIn Here</button>
        <button class="btn btn-sm btn-outline-danger" type="reset">Reset Form</button>
      </div>
    </form>
  </div>
</body>

</html>