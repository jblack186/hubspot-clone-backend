<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$conn=mysqli_connect("localhost","root","root","HBSCdb");


if (
    isset($data->userid)
    && isset($data->fullname)
    && isset($data->ticketdescription)
    || !empty(trim($data->phonenumber))
    || !empty(trim($data->companyname))

) {
    $userID = mysqli_real_escape_string($db_conn, ($data->userid));
    $userfullname = mysqli_real_escape_string($db_conn, trim($data->fullname));
    $userticketdescription = mysqli_real_escape_string($db_conn, trim($data->ticketdescription));
    $userphonenumber = mysqli_real_escape_string($db_conn, trim($data->phonenumber));
    $usercompanyname = mysqli_real_escape_string($db_conn, trim($data->companyname));
    
    // $sql=mysqli_query($conn,"SELECT * FROM users where id='$userID'");

    $insertTicket = mysqli_query($db_conn, "INSERT INTO `Tickets`(`userid`,`fullname`,`ticketdescription`, `phonenumber`, `companyname`) VALUES('$userID','$userfullname', '$userticketdescription','$userphonenumber', '$usercompanyname')");
    if ($insertTicket) {
      $last_entry = mysqli_insert_id($db_conn);
      echo json_encode(["id" => $last_entry, "name" => $userfullname, "desc" => $userticketdescription]);
      http_response_code(201);
} else {
  echo $db_conn->error;;
}

}