<?php
  require('credentials.php');

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Create database
  $sql = "CREATE DATABASE $dbname";
  if (mysqli_query($conn, $sql)) {
      echo "Database created successfully<br>";
  } else {
      echo "Error creating database: " . mysqli_error($conn) . "<br>";
  }
  
  // Create database
  $sql = "use $dbname";
  if (mysqli_query($conn, $sql)) {
      echo "Database selected successfully<br>";
  } else {
      echo "Error creating database: " . mysqli_error($conn) . "<br>";
  }

  // get tables from tables.sql file
  $sql = file_get_contents('tables.sql');

  if (mysqli_multi_query($conn, $sql)) {
      echo "Tables created successfully<br>";
  } else {
      echo "Error creating table: " . mysqli_error($conn) . "<br>";
  }

  mysqli_close($conn);
?>
