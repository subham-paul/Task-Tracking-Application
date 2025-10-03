<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Of All Tasks</title>

</head>

<body>
  <div class="container-fluid">
    <?php
    include_once("./assets/plugins.php");
    include_once("auth.php");
    include_once("navbar.php");
    if (!empty($_SESSION['message'])) {
      if ($_SESSION['message'] == "task_delete_success") {
        echo "<div class='alert alert-info'>One Task Deleted.</div>";
      } else {
        echo "<div class='alert alert-danger'>Unable to delete</div>";
      }
      unset($_SESSION['message']);
    }
    ?>
    <header class="modal-header">
      <h4>List Of All Tasks</h4>
    </header>
    <table class="table table-hover">
      <tr>
        <th>View Details</th>
        <th>Task Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Added By</th>
      </tr>

      <?php
      include("db.php");
      try {
        $con = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected";
        $isAdmin = ($_SESSION['ROLE'] == "admin") ? true : false;
        $SQL = "";
        if ($isAdmin) {
          $SQL = "select tasks.*,users.name,users.role 
                  from tasks inner join users 
                  on(tasks.user_id = users.user_id)";
        } else {
          $SQL = "select tasks.*,users.name,users.role
                  from tasks inner join users 
                  on(tasks.user_id = users.user_id)
                  and users.user_id='" . $_SESSION['USER-ID'] . "'";
        }
        $stmt = $con->prepare($SQL);
        $stmt->execute();
        // print '<pre>';
        $className = "";
        while ($rows = $stmt->fetch(PDO::FETCH_LAZY)) {
          // print_r($rows->title);
          if ($rows->status == "Pending") {
            $className = "badge-warning";
          } else if ($rows->status == "Completed") {
            $className = "badge-success";
          } else if ($rows->status == "Rejected") {
            $className = "badge-danger";
          }
      ?>
          <tr>
            <td><a class="btn btn-sm btn-outline-primary" 
            href="view_tasks?tid=<?php echo $rows->task_id; ?>">Click Here</a></td>
            <td><?php echo ucwords($rows->title); ?></td>
            <td><?php echo ucwords($rows->description); ?></td>
            <td><span class="badge badge-pills <?php echo $className; ?>"><?php echo $rows->status; ?></span></td>
            <td><?php echo date("d-m-y h:i:sA", strtotime($rows->created)); ?></td>
            <td><?php echo ucwords($rows->name); ?></td>
          </tr>
      <?php
        }
        #closing the Prepared Statement 
        $stmt = NULL;
        #Closing the Database connection by set con to NULL.
        $con = NULL;
      } catch (PDOException $ex) {
        die("Connection failed " . $ex->getMessage());
      }
      ?>

    </table>
    <div align="center">
      <a href="add_tasks" class="btn btn-sm btn-outline-dark">Add New Task</a>
    </div>
  </div>

</body>

</html>