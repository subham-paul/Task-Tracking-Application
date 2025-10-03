<?php
session_start();
function redirect($loc) {
  echo "<script>
          window.location.href='$loc';
        </script>";
}
if (!empty($_SESSION['USER'])) {
?>
  <div class="float-right">
    Welcome <?php echo $_SESSION['USER']; ?>
    <a href="index">Profile</a> |
    <a href="logout">Logout</a>
  </div>
<?php
} else {
  redirect("signin");
}
?>