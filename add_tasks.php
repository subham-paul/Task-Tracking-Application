<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Task</title>
</head>

<body>

  <div class="container">
    <?php
    include_once("./assets/plugins.php");
    include_once("auth.php");
      include_once("navbar.php");

    if (!empty($_SESSION['message'])) {
      if ($_SESSION['message'] == "task_add_success") {
        echo "<div class='alert alert-success'>Task Added Successfully...<a class='btn btn-sm btn-link' href='tasks'>View All Tasks</a></div>";
      } else if ($_SESSION['message'] == "task_add_error") {
        echo "<div class='alert alert-danger'>Unable to add Task. Please try again later</div>";
      }
      unset($_SESSION['message']);
    }
    ?>

    <header class="modal-header">
      <h4>New Task Add Here</h4>
    </header>
    <form method="POST" action="taskadd">
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="title">Title :</label>
            <input type="text" name="title" id="title" required class="form-control">
          </div>

          <div class="col">
            <label for="status">Status :</label>
            <select name="status" class="form-control" required>
              <option>---- Choose a Status ----</option>
              <option>Pending</option>
              <option>Rejected</option>
              <option>Completed</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="desc">Description :</label>
        <textarea name="desc" id="desc" cols="30" rows="10" required class="form-control"></textarea>
      </div>
      <div class="form-group">

      </div>
      <div class="form-group" align="right">
        <button class="btn btn-sm btn-outline-success">Add Task</button>
        <button class="btn btn-sm btn-outline-danger" type="reset">Reset Form</button>
      </div>
    </form>
  </div>
</body>

</html>