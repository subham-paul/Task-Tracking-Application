<?php 
include_once("auth.php");

#delete entire session of the application
session_destroy();
redirect("signin");

?>