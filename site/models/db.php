<?php

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "tumoChat"; // Database name
  $domain_name = "http://localhost/tumoChat/site/";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $database);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

?>