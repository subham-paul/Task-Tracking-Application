<?php
session_start();
function redirect($loc) {
  echo "<script>
          window.location.href='$loc';
        </script>";
}
$userId = $_SESSION['USER-ID'];
$title  = $_POST['title'];
$desc   = $_POST['desc'];
$status = $_POST['status'];

include("db.php");
function generateTaskId() {
  return "tasks-" . rand(1000, 9999) . "-" . time();
}
try {
  $con = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
  //Error enabled for connectivity test
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected";
  $SQL = "insert into tasks(task_id,title,description,status,user_id)
          values(:tid,:title,:desc,:status,:user_id)";
  $stmt = $con->prepare($SQL);
  $stmt->execute([
    'tid' => generateTaskId(),
    "title" => $title,
    "desc" => $desc,
    "status" => $status,
    "user_id" => $userId

  ]);
  $rows = $stmt->rowCount();
  $message = ($rows == 1) ? "task_add_success" : "task_add_error";
  $_SESSION['message'] = $message;
  #Close the prepared Statement
  $stmt = NULL;
  #Close The Database connection.
  $con = NULL;
  redirect("add_tasks");
} catch (PDOException $ex) {
  die($ex->getMessage());
}
