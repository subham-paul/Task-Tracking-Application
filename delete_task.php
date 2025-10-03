<?php
session_start();
function redirect($loc) {
  echo "<script>
          window.location.href='$loc';
        </script>";
}
$taskId = $_GET['tid'];
include("db.php");
try {
  $con = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
  //Error enabled for connectivity test
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected";
  $SQL = "delete from tasks where task_id=:tid";
  $stmt = $con->prepare($SQL);
  $stmt->execute(['tid' => $taskId]);
  $rows = $stmt->rowCount();
  $message = ($rows == 1) ? "task_delete_success" : "task_delete_error";
  $_SESSION['message'] = $message;
  $stmt = NULL;
  $con = NULL;
  redirect("tasks");
} catch (PDOException) {
  die($ex->getMessage());
}
