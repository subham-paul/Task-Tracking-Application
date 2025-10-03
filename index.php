<?php
include_once("./assets/plugins.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>List Of All Users</title>
</head>

<body>
   <div class="container-fluid">
      <?php
      include_once("auth.php");
      include_once("navbar.php");
      if (!empty($_SESSION['message'])) {
         if ($_SESSION['message'] == "delete_success") {
            echo "<div class='alert alert-success'>User's Profile removed successfully...</div>";
         } else if ($_SESSION['message'] == "delete_error") {
            echo "<div class='alert alert-danger'>Unable to Remove User's account...</div>";
         }
         unset($_SESSION['message']);
      } ?>
      <header class="modal-header">
         <h4>Displaying All Users Details</h4>
      </header>
      <div class="card p-3 m-3">
         <div class="table-responsive">
            <table class="table table-hover">
               <tr>
                  <th>View Details</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Languages Speak</th>
                  <th>Educational Qualifications</th>
                  <th>User Picture</th>
                  <th>Created At</th>
               </tr>

               <?php
               //Database cridentials.
               //root => default mysql user
               //password => blank
               //database => usersDB
               //host => localhost | 127.0.0.1
               include_once("db.php");
               $con = new MYSQLi(HOST, USER, PASS, DB);
               //check the connection 
               if ($con->connect_error) {
                  die($con->connect_error);
               } else {
                  //echo "Connected ";
                  //close the database connection
                  $isAdmin = ($_SESSION['ROLE'] == 'admin') ? true : false;
                  if ($isAdmin) {
                     $SQL = "select * from users";
                  } else {
                     $SQL = "select * from users where user_id='" . $_SESSION['USER-ID'] . "'";
                  }
                  //PreparedStatement Object which prevents SQL Injection spamming attack.

                  $stmt = $con->prepare($SQL);
                  $stmt->execute();
                  $resultSet = $stmt->get_result();
                  //print '<pre>';
                  /*
                     To fetch values php has provided us three methods 
                     fetch_assoc() => column name as key
                     fetch_row()   => column index position
                     fetch_array() => Both column name as key+ cloumn index position
                                    => fetch_assoc()+fetch_row()
                  */
                  while ($rows = $resultSet->fetch_assoc()) {
                     // print_r($rows['name']);
               ?>
                     <tr>
                        <td><a class="btn btn-sm btn-outline-info"
                              href="view?uid=<?php echo $rows['user_id']; ?>">Show Details</a></td>
                        <td><?php echo ucwords($rows['name']); ?></td>
                        <td><?php echo $rows['phone']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <td><?php echo $rows['languages']; ?></td>
                        <td><?php echo $rows['educations']; ?></td>
                        <td><img src="<?php echo $rows['profile_pic']; ?>" height="80px" width="80px"
                              class="rounded-circle" title="<?php echo $rows['name'] ?>'s Pic" /></td>
                        <td><?php echo date("d-m-y h:i:sA", strtotime($rows['created'])); ?></td>
                     </tr>

               <?php
                  }
                  //PreparedStatement close 
                  $stmt->close();
                  //Database connection close 
                  $con->close();
               }
               ?>

            </table>

         </div>
      </div>
   </div>
</body>

</html>