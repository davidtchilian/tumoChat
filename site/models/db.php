<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "TumoChat"; // Database name


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// $con = mysqli_connect("localhost","root","","register");
//     if (mysqli_connect_errno()){
// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
// 	die();
// 	}

// date_default_timezone_set('Asia/Karachi');
// $error="";



// ?>
