<?php

require 'db_connection.php';

$headers = apache_request_headers();

$grab = $headers['userid'];




$get_tickets = "SELECT * FROM tickets WHERE userid='$grab'";

$conn=mysqli_connect("localhost","root","root","HBSCdb");


$result = mysqli_query($db_conn, $get_tickets);


while($row = mysqli_fetch_assoc($result)) {
  echo json_encode(["contact" => $row['fullname'], "description" => $row['ticketdescription'], "company" => $row['companyname']]);
}


