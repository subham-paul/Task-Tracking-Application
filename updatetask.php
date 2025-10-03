<?php
session_start();
function redirect($loc) {
   echo "<script>
            window.location.href='$loc';
         </script>";
}

include("db.php");
#print_r($_POST);
#print_r($_SESSION);

$title = $_POST['editTitle'];
$desc =  $_POST['editDesc'];
$status = $_POST['editStatus'];
$user_id = $_SESSION['USER-ID'];
$taskId = $_POST['h_task_id'];
try {
   $con = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
   //Error enabled for connectivity test
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   echo "Connected";
   $SQL = "update tasks set 
                        title =:title,
                        description  =:desc,
                        status=:status
                        where task_id=:tid";

   $stmt = $con->prepare($SQL);
   $stmt->execute([
      "title" => $title,
      "desc" => $desc,
      "status" => $status,
      "tid"   => $taskId
   ]);
   $rows = $stmt->rowCount();
   $message = ($rows == 1) ? "task_update_success" : "task_update_error";
   $_SESSION['message'] = $message;
   #Close the PreparedStatement
   $stmt = NULL;
   #Close The Database connection.
   $con =  NULL;
   redirect("view_tasks?tid=$taskId");
} catch (PDOException $ex) {
   die($ex->getMessage());
}
?>
