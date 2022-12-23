<?php

$con = mysqli_connect("127.0.0.1","ec2-user","shestel107","streamingdb");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>