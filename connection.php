<?php

// connecting to the database
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "employee_db";

// creating connection object
$conn = mysqli_connect($server_name, $user_name, $password, $db_name);

if(!$conn){
    die("Connection Failed!!! " - mysqli_connect_error());
}

?>