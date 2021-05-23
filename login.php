<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// POST DATA
$data = json_decode(file_get_contents("php://input"));

if (
    isset($data->firstname)
    && isset($data->lastname)
    && isset($data->googleid)
    && isset($data->email)
    && isset($data->phonenumber)
    && isset($data->companyname)
    && !empty(trim($data->firstname))
    && !empty(trim($data->lastname))
    && !empty(trim($data->googleid))
    && !empty(trim($data->email))
    || !empty(trim($data->phonenumber))
    || !empty(trim($data->companyname))

) {
    $userfirstname = mysqli_real_escape_string($db_conn, trim($data->firstname));
    $userlastname = mysqli_real_escape_string($db_conn, trim($data->lastname));
    $usergoogleid = mysqli_real_escape_string($db_conn, trim($data->googleid));
    $useremail = mysqli_real_escape_string($db_conn, trim($data->email));
    $userphonenumber = mysqli_real_escape_string($db_conn, trim($data->phonenumber));
    $usercompanyname = mysqli_real_escape_string($db_conn, trim($data->companyname));
    
    $conn=mysqli_connect("localhost","root","root","HBSCdb");

    $sql=mysqli_query($conn,"SELECT * FROM users where googleid='$usergoogleid'");

    if(mysqli_num_rows($sql)>0) {
      echo http_build_query($data);
      http_response_code(200);
      exit;
}

    else if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $insertUser = mysqli_query($db_conn, "INSERT INTO `users`(`firstname`,`lastname`,`googleid`,`email`, `phonenumber`, `companyname`) VALUES('$userfirstname','$userlastname', '$usergoogleid','$useremail', '$userphonenumber', '$usercompanyname')");
        if ($insertUser) {
            $last_id = mysqli_insert_id($db_conn);
            echo json_encode(["success" => 1, "msg" => "User Inserted.", "id" => $last_id]);
            http_response_code(201);

        } else {
            echo json_encode(["success" => 0, "msg" => "User Not Inserted!"]);
        }
    } else {
        echo json_encode(["success" => 0, "msg" => "Invalid Email Address!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}