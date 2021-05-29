<?php

require 'db_connection.php';

$headers = apache_request_headers();

$grab = $headers['userid'];




$get_tickets = "SELECT * FROM tickets WHERE userid='$grab'";

$conn=mysqli_connect("localhost","root","root","HBSCdb");


$result = mysqli_query($conn, $get_tickets);

$numrows = mysqli_num_rows($result);


if($numrows > 0) {
while($row = mysqli_fetch_assoc($result)) {
  $name=$row['fullname'];
  $companyname=$row['companyname'];
  $description=$row['ticketdescription'];

  $sendResult['userTickets'][] =  $tickets = array("contact" => $name, "description" => $description, "company" => $companyname);


}
}

else
{
    $sendResult[] = 'No Patients yet';
}

echo json_encode($sendResult);


