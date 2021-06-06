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
  $id=$row['id'];
  $name=$row['fullname'];
  $companyname=$row['companyname'];
  $description=$row['ticketdescription'];
  $ticketstatus=$row['ticketStatus'];


  $sendResult['userTickets'][] =  $tickets = array("id" => $id, "contact" => $name, "description" => $description, "company" => $companyname, "ticketStatus" => $ticketstatus);


}
}

else
{
    $sendResult[] = 'No Patients yet';
}

echo json_encode($sendResult);


