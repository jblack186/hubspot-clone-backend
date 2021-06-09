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
    && isset($data->status)

) {
    $id = mysqli_real_escape_string($db_conn, ($data->id));
    $status = mysqli_real_escape_string($db_conn, trim($data->status));


    $changeTicket = mysqli_query($db_conn, "UPDATE `Tickets` SET `ticketStatus` = '$status' WHERE (`id` = '$id')");
    if ($changeTicket) {
      echo json_encode(["success" => $changeTicket]);
      http_response_code(202);
} else {
  echo $db_conn->error;
}

}