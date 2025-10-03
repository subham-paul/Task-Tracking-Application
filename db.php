<?php

$env = parse_ini_file(".env");
#------This is for MYSQLi Global Connection -----# 
define("HOST", $env['HOST']);
define("USER", $env['USER']);
define("PASS", $env['PASS']);
define("DB", $env['DB']);

#--This is for PDO Global connection --------------#
$HOST = $env['HOST'];
$DB   = $env['DB'];
$USER = $env['USER'];
$PASS = $env['PASS'];
?>