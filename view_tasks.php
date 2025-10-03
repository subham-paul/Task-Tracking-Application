<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Details</title>
</head>

<body>
  <div class="container">
    <?php
    include_once("auth.php");
    include_once("./assets/plugins.php");
      include_once("navbar.php");
    if (!empty($_SESSION['message'])) {
      if ($_SESSION['message'] == "task_update_success") {
        echo "<div class='alert alert-info'>One Task Updated.</div>";
      } else if ($_SESSION['message'] == "task_update_error") {
        echo "<div class='alert alert-danger'>Unbale to Update</div>";
      }
      unset($_SESSION['message']);
    }

    include_once("db.php");
    try {
      $con = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected";
      $SQL = "select * from tasks where task_id=:tid";
      $stmt = $con->prepare($SQL);
      $stmt->execute(['tid' => $_GET['tid']]);
      $className = "";
      if ($rows = $stmt->fetch(PDO::FETCH_OBJ)) {
        //print_r($rows);
        $className = ($rows->status == "pending") ? "badge-warning" : (($rows->status == "completed") ? "badge-success" : "badge-danger");

    ?>
        <header class="modal-header">
          <h4>Showing the details of <span class="text-primary"><?php echo ucwords($rows->title); ?> </span>:</h4>
        </header>

        <div class="card p-3 m-3">
          <form method="POST" action="updatetask">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="editTitle">Title :</label>
                  <input type="text" name="editTitle" value="<?php echo $rows->title; ?>" class="form-control">
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="editStatus">Status :</label>
                    <select name="editStatus" class="form-control" required>
                      <option value="">--- Choose a Status ---</option>
                      <option <?php if ($rows->status == "Pending") echo "selected"; ?>>Pending</option>
                      <option <?php if ($rows->status == "Rejected") echo "selected"; ?>>Rejected</option>
                      <option <?php if ($rows->status == "Completed") echo "selected"; ?>>Completed</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="editDesc">Description :</label>
              <textarea name="editDesc" id="editDesc" cols="30" rows="10" 
              class="form-control"><?php echo $rows->description; ?></textarea>
            </div>
            <!--capturing taskid into the hidden field -->
            <input type="hidden" name="h_task_id" value="<?php echo $rows->task_id; ?>">
            <div class="form-group">
              <label for="" class="font-weight-bold">Created At:</label>
              <?php echo  date("d-m-y h:i:sA", strtotime($rows->created)); ?>
            </div>
            <div align="center">
              <button class="btn btn-sm btn-outline-success">Update Task</button>
              <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Do You want to Delete This Task ?');"
                href="delete_task?tid=<?php echo $rows->task_id; ?>">Delete Task</a>
              <a href="tasks" class="btn btn-sm btn-outline-dark">View All Tasks</a>
            </div>
          </form>
        </div>
    <?php
      }
      $stmt = NULL;
      $con = NULL;
    } catch (PDOException $ex) {
      die($ex->getMessage());
    }
    ?>

  </div>
</body>

</html>