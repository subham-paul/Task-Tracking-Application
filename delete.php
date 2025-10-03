<?php
include_once("auth.php");
$userID = (!empty($_GET['uid'])) ? $_GET['uid'] : null;
include_once("db.php");
$con = new MYSQLi(HOST, USER, PASS, DB);
if ($con->connect_error) die($con->connect_error);
else {
   // echo "Connected";
   $SQL = "delete from users where user_id=?";
   $stmt = $con->prepare($SQL);
   $stmt->bind_param("s", $userID);
   $stmt->execute();
   $rows = $stmt->affected_rows;
   $message = ($rows == 1) ? "delete_success" : "delete_error";
   $_SESSION['message'] = $message;
   redirect("index");
   $stmt->close();
   $con->close();
}
?>
