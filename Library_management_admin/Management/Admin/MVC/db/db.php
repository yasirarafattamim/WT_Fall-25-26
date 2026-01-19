<?php
// Management/Admin/MVC/db/db.php

 $host = 'localhost';
 $user = 'root';
$pass = '';
$dbname = 'library_management_admin';

 $conn = new mysqli($host, $user, $pass, $dbname);

if   ($conn->connect_error) {
     die("Connection Fail: " . $conn->connect_error);
}

?>
