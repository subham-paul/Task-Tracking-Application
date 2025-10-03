<?php
session_start();
function redirect($loc) {
  echo "<script>
          window.location.href='$loc';
        </script>";
}
if (!empty($_SESSION['USER'])) {
?>
  <div class="float-right m-3 p-3">
    Welcome, <span class="font-weight-bold"><?php echo $_SESSION['USER']; ?></span>
    <a href="view?uid=<?php echo $_SESSION['USER-ID']; ?>">
      <img src="<?php echo $_SESSION['U-IMG']; ?>" height="30px" width="30px"
        class="rounded-circle" title="<?php echo $_SESSION['USER']; ?>'s Pic" /></a> |
    <a class="btn btn-sm btn-outline-danger" href="logout">Logout</a>
  </div>
<?php
} else {
  redirect("signin");
}
?>