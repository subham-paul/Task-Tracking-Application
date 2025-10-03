<?php
session_start();
function redirect($loc) {
  echo "<script>
          window.location.href='$loc';
        </script>";
}
#print_r($_POST);

$email = $_POST['email'];
$pass1 = $_POST['pass1'];

//Database connection 
include_once("db.php");

$con = new MYSQLi(HOST, USER, PASS, DB);
if ($con->connect_error) {
  die($con->connect_error);
}
# echo "Connected";
#close the Database connection
$SQL = "select user_id,name,pass1,role,profile_pic from users where email=?";
$stmt = $con->prepare($SQL);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultSet = $stmt->get_result();
#closing the Prepared Statement
$stmt->close();
#Closing the Database connection.
$con->close();

if ($rows = $resultSet->fetch_assoc()) {
  # print_r($rows);
  $db_pass = $rows['pass1'];
  //die($db_pass);
  $isMatch = password_verify($pass1, $db_pass) ? true : false;
  if ($isMatch) {
    //echo "Login Success";
    //We will store user's information
    $_SESSION['USER-ID']    = $rows['user_id'];
    $_SESSION['USER']       = $rows['name'];
    $_SESSION['ROLE']       = $rows['role'];
    $_SESSION['IP']         = $_SERVER['REMOTE_ADDR'];
    $_SESSION['U-IMG']      = $rows['profile_pic'];
    date_default_timezone_set("Asia/kolkata");
    $_SESSION['login_time'] = date("d-m-y h:i:sA");
    //If loggedIn Successfull Then we redirect to tasks page.
    redirect("tasks");
  } else {
    //echo "Invalid Username or Password";
    $_SESSION['message'] = "wrong_credentials";
    redirect("signin");
  }
} else {
  // echo "User doesnot exists";
  $_SESSION['message'] = "user_not_exists";
  redirect("signin");
}
?>
