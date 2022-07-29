<?php

  include "../config/config.php";

  $host = $config['DB_HOST'];
  $username = $config['DB_USERNAME'];
  $password = $config['DB_PASSWORD'];
  $database = $config['DB_DATABASE'];
  $port = $config['DB_PORT'];

  $conn = mysqli_connect($host, $username, $password, $database, $port);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
?>