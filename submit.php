<?php
include_once("auth.php");
function generateUserId() {
   return "user-" . rand(1000, 9999) . "-" . time();
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST") {
   //print_r($_POST);
   //print_r($_FILES);
   // die();
   $fileName = rand(1000, 9999) . "-" . time() . "-" . $_FILES['avatar']['name'];
   $fileSize = $_FILES['avatar']['size']; //bytes
   $fileType = $_FILES['avatar']['type'];
   $fileTmp  = $_FILES['avatar']['tmp_name'];
   $imagePath = "./uploads/" . $fileName;
   if ($fileType == "image/jpg" || $fileType == "image/jpeg" || $fileType == "image/png" || $fileType == "image/gif") {
      if ($fileSize <= 800 * 1024) {
         move_uploaded_file($fileTmp, $imagePath);
         //file successfully uploaded
         //Then start the Database connection
         $userId = generateUserId();
         $name = $_POST['fname'] . ' ' . $_POST['lname'];
         $phone = $_POST['phone'];
         $email = $_POST['email'];
         $pass1 = $_POST['pass1'];
         $languages = implode(",", $_POST['lang']);
         $educations = implode(",", $_POST['ch']);
         #Here we are hahsing the password.
         $hashPass = password_hash($pass1, PASSWORD_BCRYPT);

         //inserting it to Database now.
         include_once("db.php");
         $con = new MYSQLi(HOST, USER, PASS, DB);
         if ($con->connect_error) {
            die($con->connect_error);
         }
         else {
            // echo "Connected";
            $SQL = "insert into users(user_id,name,phone,email,pass1,profile_pic,languages,educations)
                     values(?,?,?,?,?,?,?,?)";
            //? => Substitute operator or Bind Parameter of PreparedStatement class which prevents SQL Injection.
            $stmt = $con->prepare($SQL);
            $stmt->bind_param("ssssssss", $userId, $name, $phone, $email, $hashPass, $imagePath, $languages, $educations);
            $stmt->execute();
            $rows = $stmt->affected_rows;
            $message = ($rows == 1) ? "signup_success" : "signup_error";
            //echo $message;
            $_SESSION['message'] = $message;
            //close the PreparedStatement 
            $stmt->close();
            //close the Database connection.
            $con->close();
            redirect("signup");
         }
      } else {
         $_SESSION['message'] = "too_large_image_error";
         //redirect back to signup.php
         redirect("signup");
      }
   } else {
      $_SESSION['message'] = "invalid_image_error";
      redirect("signup");
   }
} else {
   redirect("signup");
}
