<?php

require 'db_connection.php';

$conn=mysqli_connect("localhost","root","root","HBSCdb");

$get_users = "SELECT * FROM users";

$result = mysqli_query($conn, $get_users);

while($row = mysqli_fetch_assoc($result)) {
  echo json_encode(["firstname" => $row['firstname'], "lastname" => $row['lastname'], "email" => $row['email']]);
}
