<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

  $serverName = "localhost";
  $username = "root";
  $password = "root";
  $databseName = "HBSCdb";
  $conn = mysqli_connect($serverName,$username,$password, $databseName);
