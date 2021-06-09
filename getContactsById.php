<?php

require 'db_connection.php';

$headers = apache_request_headers();

$grab = $headers['userid'];


$conn=mysqli_connect("localhost","root","root","HBSCdb");

$get_contacts = "SELECT * FROM contact WHERE contactid='$grab'";

$result = mysqli_query($conn, $get_contacts);

while($row = mysqli_fetch_assoc($result)) {
  echo json_encode(["firstname" => $row['firstname'], "lastname" => $row['lastname'], "email" => $row['email']]);
}
