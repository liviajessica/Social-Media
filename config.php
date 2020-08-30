<?php
    $host = "localhost";
    $user = "id8863927_root";
    $password = "testing";
    $dbname = "id8863927_student";
    
    $con = mysqli_connect($host, $user, $password,$dbname);
    // Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
}