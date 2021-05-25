<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$conn=mysqli_connect("localhost","root","root","HBSCdb");

$get_users = "SELECT * FROM users";

$result = mysqli_query($conn, $get_users);

while($row = mysqli_fetch_assoc($result)) {
  echo json_encode(["firstname" => $row['firstname'], "lastname" => $row['lastname'], "email" => $row['email']]);
}
