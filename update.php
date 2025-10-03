<?php
include("auth.php");

// print '<pre>';
# Incoming Text Data
// print_r($_POST);
#Incoming file Data
// print_r($_FILES);
$userID = $_POST['hid'];
$imagePath = "";
if ($_FILES['editAvatar']['error'] == 0) {
  //die("Image has been changed");
  $fileName = rand(1000, 9999) . "-" . time() . "-" . $_FILES['editAvatar']['name'];
  $fileType = $_FILES['editAvatar']['type'];
  $fileSize = $_FILES['editAvatar']['size']; // Img Size Show in bytes
  $fileTmp  = $_FILES['editAvatar']['tmp_name'];

  if ($fileType == "image/jpeg" || $fileType == "image/jpg" || $fileType == "image/png" || $fileType == "image/gif") {
    if ($fileSize <= 800 * 1024) {
      $imagePath = "./uploads/" . $fileName;
      move_uploaded_file($fileTmp, $imagePath);
    } else {
      //die("Image is too large to upload");
      $_SESSION['message'] = "image_size_error";
      redirect("view?uid=" . $userID);
    }
  } else {
    //die("Invalid Image");
    $_SESSION['message'] = "invalid_image_error";
    redirect("view?uid=" . $userID);
  }
} else {
  //die("Image kept same");
  $imagePath = $_POST['h_image_path'];
}

$name       = $_POST['editFname'] . ' ' . $_POST['editLname'];
$phone      = $_POST['editPhone'];
$email      = $_POST['editEmail'];
$educations = implode(",", $_POST['ch']);
$languages  = implode(",", $_POST['lang']);

include_once("db.php");
$con = new MYSQLi(HOST, USER, PASS, DB);
if ($con->connect_error) die($con->connect_error);
else {
  echo "Connected";
  $SQL = "update users set
                          name=?,
                          phone=?,
                          email=?,
                          languages=?,
                          educations=?,
                          profile_pic=?
                          where user_id=?";
  #Convert to PreparedStatement for SQL Injection protection
  $stmt = $con->prepare($SQL);
  $stmt->bind_param("sssssss", $name, $phone, $email, $languages, $educations, $imagePath, $userID);
  $stmt->execute();
  $rows = $stmt->affected_rows;
  $message = ($rows == 1) ? "update_success" : "update_error";
  $_SESSION['message'] = $message;
  $stmt->close();
  $con->close();
  redirect("view?uid=" . $userID);
}
?>