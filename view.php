<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View User Details:</title>
</head>

<body>
  <?php
  include_once("./assets/plugins.php");
  if (!empty($_SESSION['message'])) {
    if ($_SESSION['message'] == "update_success") {
      echo "<div class='alert alert-success'>User's Profile Updated Successfully...</div>";
    } else if ($_SESSION['message'] == "update_error") {
      echo "<div class='alert alert-warning'>Unable to Update User's Profile. Please try again later...</div>";
    } else if ($_SESSION['message'] == "image_size_error") {
      echo "<div class='alert alert-danger'>Image Size is too large to Upload. Max Uploaded Limit is 800KB</div>";
    } else if ($_SESSION['message'] == "invalid_image_error") {
      echo "<div class='alert alert-info'>Only Image are accepted.</div>";
    }
    unset($_SESSION['message']);
  }
  ?>
  <div class="container">
    <?php
      include_once("navbar.php");
  include_once("auth.php");
    $userId = !(empty($_GET['uid'])) ? $_GET['uid'] : null;
    if ($userId) {
      include_once("db.php");
      $con = new MYSQLi(HOST, USER, PASS, DB);
      if ($con->connect_error) die($con->connect_error);
      else {
        // echo "Connected";
        $SQL = "select * from users where user_id=?";
        $stmt = $con->prepare($SQL);
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $resultSet = $stmt->get_result();
        if ($rows = $resultSet->fetch_assoc()) {
          // print_r($rows);
          $nameArr = explode(" ", $rows['name']);
          //print_r($nameArr);
    ?>
          <div class="card p-3 m-3">
            <header class="modal-header">
              <h4>Showing <span class="text-success"> <?php echo strtoupper($rows['name']); ?></span>'s Info:</h4>
            </header>
            <form method="POST" enctype="multipart/form-data" action="update">
              <div class="row">
                <div class="col">

                  <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label for="editFname">FirstName :</label>
                      <input type="text" name="editFname" value="<?php echo $nameArr[0]; ?>" class="form-control">
                    </div>
                    <div class="col">
                      <label for="editLname">LastName :</label>
                      <input type="text" name="editLname" value="<?php echo $nameArr[1]; ?>" class="form-control">
                    </div>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="editPhone">Phone :</label>
                    <input type="number" name="editPhone" value="<?php echo $rows['phone']; ?>" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="editEmail">Email-Id :</label>
                    <input type="text" name="editEmail" value="<?php echo $rows['email']; ?>" class="form-control"> 
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <?php $languages = explode(",", $rows['languages']);
                        //print_r($languages);
                        ?>
                        <label for="lang">Languages Known :</label>
                        <select multiple name="lang[]" class="form-control" required>
                          <option <?php if (in_array("English", $languages)) { echo "selected"; } ?>>English</option>
                          <option <?php if (in_array("Bengali", $languages)) { echo "selected"; } ?>>Bengali</option>
                          <option <?php if (in_array("Hindi", $languages)) { echo "selected"; } ?>>Hindi</option>
                          <option <?php if (in_array("Tamil", $languages)) { echo "selected"; } ?>>Tamil</option>
                          <option <?php if (in_array("Telegu", $languages)) { echo "selected"; } ?>>Telegu</option>
                        </select>
                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple option</small>
                      </div>
                      <div class="col">
                        <?php $educations = explode(",", $rows['educations']);
                        // print_r($educations); 
                        ?>
                        <div class="form-group">
                          <label for="ch">Educational Qualifications :</label>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" onchange="checkAll(this)" name="ch_all" id="ch_all">
                            <label for="ch_all">Select All</label>
                          </div>
                          <input type="checkbox" name="ch[]" id="ch1" value="10th" 
                          <?php if (in_array("10th", $educations)) { echo "checked"; } ?>>10<sup>th</sup>

                          <input type="checkbox" name="ch[]" id="ch2" value="12th" 
                          <?php if (in_array("12th", $educations)) { echo "checked"; } ?>>12<sup>th</sup>

                          <input type="checkbox" name="ch[]" id="ch3" value="Graduation" 
                          <?php if (in_array("Graduation", $educations)) { echo "checked"; } ?>>Graduation

                          <input type="checkbox" name="ch[]" id="ch4" value="Post-Graduation" 
                          <?php if (in_array("Post-Graduation", $educations)) { echo "checked"; } ?>>Post Graduation
                        </div>

                        <script>
                          function checkAll(checkField) {
                            var ch1 = document.getElementById("ch1");
                            var ch2 = document.getElementById("ch2");
                            var ch3 = document.getElementById("ch3");
                            var ch4 = document.getElementById("ch4");

                            if (checkField.checked) {
                              ch1.checked = ch2.checked = ch3.checked = ch4.checked = true;
                            } else {
                              ch1.checked = ch2.checked = ch3.checked = ch4.checked = false;
                            }
                          }
                        </script>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="" class="font-weight-bold">Account Created : </label>
                    <?php echo date("d-m-y h:i:sA", strtotime($rows['created'])); ?>
                  </div>

                  <!--Capturing the user_id in a hidden field -->
                  <input type="hidden" name="hid" value="<?php echo $rows['user_id']; ?>">
                  <!--Capturing old Image Path into the hidden field -->
                  <input type="hidden" name="h_image_path" value="<?php echo $rows['profile_pic']; ?>">
                </div>

                <div class="col">
                  <img id="img01" src="<?php echo $rows['profile_pic']; ?>" height="200px" width="200px" 
                  alt="User Image" title="<?php echo $rows['name']; ?>'s Pic">
                  
                  <div class="form-group">
                    <label for="editAvatar">Change Profile Pic : </label>
                    <input type="file" name="editAvatar" id="editAvatar" class="form-control" onchange="loadImage(event)">
                    
                    <script type="text/javascript">
                      function loadImage(event) {
                        let file = event.target.files[0];
                        let imageBLOB = URL.createObjectURL(file);
                        document.getElementById("img01").src = imageBLOB;
                      }
                    </script>
                  </div>
                </div>
              </div>
              <div class="from-group" align="center">
                <button class="btn btn-sm btn-outline-success">Update User</button>
                <a onclick="return confirm('Do You want to Delete This Record ?');" href="delete?uid=<?php echo $rows['user_id']; ?>" 
                class="btn btn-sm btn-outline-danger">Delete User</a>
                <a class="btn btn-sm btn-outline-dark" href="index">Back From Here</a>
              </div>
            </form>
          </div>
    <?php
        }
        $stmt->close();
        $con->close();
      }
    }
    ?>
  </div>

</body>

</html>