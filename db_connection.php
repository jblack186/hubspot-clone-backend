<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers:  *");
// header("Access-Control-Allow-Credentials: true");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");


$db_conn = mysqli_connect("localhost","root","root","HBSCdb");