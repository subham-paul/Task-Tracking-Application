<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP Form</title>
    <?php include_once("./assets/plugins.php"); ?>
</head>

<body>
    <?php
    /*One time Messaging => Flash Messaging */
    if (!empty($_SESSION['message'])) {
        if ($_SESSION['message'] == "signup_success") {
            echo "<div class='alert alert-success'>SignUP Successfully Done...</div>";
        } else if ($_SESSION['message'] == "signup_error") {
            echo "<div class='alert alert-danger'>Unable to SignUp Now, Please try again later...</div>";
        } else if ($_SESSION['message'] == "invalid_image_error") {
            echo "<div class='alert alert-warning'>Only Image files can be uploaded...</div>";
        } else if ($_SESSION['message'] == "too_large_image_error") {
            echo "<div class='alert alert-info'>Image size is too large. Max Upload size is 800KB.</div>";
        }
        unset($_SESSION['message']);
    }
    ?>
    <div class="container-fluid">
        <header class="modal-header">
            <h4>SignUp Form :</h4>
        </header>
        <form method="POST" action="submit" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="fname">FirstName :</label>
                        <input type="text" name="fname" id="fname" required class="form-control">
                    </div>
                    <div class="col">
                        <label for="lname">LastName :</label>
                        <input type="text" name="lname" id="lname" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="phone">Phone No :</label>
                        <input type="number" name="phone" id="phone" required class="form-control">
                    </div>
                    <div class="col">
                        <label for="email">Email-Id :</label>
                        <input type="text" name="email" id="email" required class="form-control">
                    </div>
                </div>
            </div>
            <!--Multi Data sending controls -->
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="lang">Languages Known:</label>
                        <select multiple name="lang[]" class="form-control" required>
                            <option>English</option>
                            <option>Bengali</option>
                            <option>Hindi</option>
                            <option>Tamil</option>
                            <option>Telegu</option>
                        </select>
                        <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple option</small>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="ch">Educational Qualifications :</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" onchange="checkAll(this)" 
                                name="ch_all" id="ch_all">
                                <label for="ch_all">Select All</label>
                            </div>
                            <input type="checkbox" name="ch[]" id="ch1" value="10th">
                            <label for="ch1" class="form-check-label">10<sup>th</sup></label>
                            <input type="checkbox" name="ch[]" id="ch2" value="12th">
                            <label for="ch2" class="form-check-label">12<sup>th</sup></label>
                            <input type="checkbox" name="ch[]" id="ch3" value="Graduation">
                            <label for="ch3" class="form-check-label">Graduation</label>
                            <input type="checkbox" name="ch[]" id="ch4" value="Post-Graduation">
                            <label for="ch4" class="form-check-label">Post Graduation</label>
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
            <!--Attatching fileupload control-->
            <div class="form-group">
                <label for="avatar">Upload Profile Pic : </label>
                <input type="file" name="avatar" id="avatar" required class="form-control" 
                accept="image/*" onchange="loadImage(event)">
                <script>
                    function loadImage(event) {
                        console.log(event.target.files[0]);
                        //Converting FileObject to BLOB => Binary Long Object.
                        const imageBlob = URL.createObjectURL(event.target.files[0]);
                        console.log(imageBlob);
                        document.getElementById("d1").innerHTML = `
                                <img src="${imageBlob}" height='100px' width='100px'/>
                            `;
                    }
                </script>
                <div id="d1"></div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="pass1">Password :</label>
                        <input type="password" name="pass1" id="pass1" required class="form-control">
                    </div>
                    <div class="col"> 
                        <label for="pass2">Confirm Password :</label>
                        <input type="password" name="pass2" id="pass2" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group" align="center">
                <button class="btn btn-sm btn-outline-success">Submit Form</button>
                <button class="btn btn-sm btn-outline-danger" type="reset">Clear Form</button>
                <a class="btn btn-sm btn-outline-success" href="signin.php">SignIn Page</a>
            </div>
        </form>
    </div>
</body>

</html>