<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

$data = json_decode(file_get_contents("php://input"));

$conn=mysqli_connect("localhost","root","root","HBSCdb");


if (
    isset($data->id)
    && isset($data->columnName)
) {
    $id = mysqli_real_escape_string($db_conn, ($data->id));
    $columName = mysqli_real_escape_string($db_conn, trim($data->columnName));
    $ticketStatus = mysqli_real_escape_string($db_conn, trim($data->ticketStatus));


    $changeTicket = mysqli_query($db_conn, "UPDATE Tickets SET $columName=ticketStatus WHERE id=$id");
    if ($changeTicket) {
      $last_entry = mysqli_insert_id($db_conn);
      echo json_encode(["id" => $last_entry, "name" => $userfullname, "desc" => $userticketdescription, 'ticketStatus' => $ticketStatus]);
      http_response_code(201);
} else {
  echo $db_conn->error;
}

}