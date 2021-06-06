<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'db_connection.php';

// $sql = "CREATE TABLE Users(
//   id INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
//   googleid VARCHAR(255) NOT NULL, 
//   firstname VARCHAR(30) NOT NULL,
//   lastname VARCHAR(30) NOT NULL,
//   email VARCHAR(50) NOT NULL,
//   phonenumber VARCHAR(30) NULL,
//   companyname VARCHAR(30) NULL
//   )";
  


// if ($db_conn->query($sql) === TRUE) {
  
//     $sql_contact = "CREATE TABLE Contact(
//         id INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
//         contactid int,
//         FOREIGN KEY (contactid) REFERENCES Users(id),
//         firstname VARCHAR(30) NOT NULL,
//         lastname VARCHAR(30) NOT NULL,
//         email VARCHAR(50) NOT NULL,
//         phonenumber VARCHAR(30) NULL,
//         companyname VARCHAR(30) NULL
//         )";


//         if ($db_conn->query($sql_contact) === TRUE) {

//               $sql_tickets = "CREATE TABLE Tickets(
//       id INT(2) PRIMARY KEY NOT NULL AUTO_INCREMENT, 
//       userid int,
//       FOREIGN KEY (userid) REFERENCES Users(id),
//       fullname VARCHAR(50) NOT NULL,
//       ticketdescription VARCHAR(255) NOT NULL,
//       phonenumber VARCHAR(50) NULL,
//       companyname VARCHAR(50) NULL,
//       ticketStatus VARCHAR(255) NOT NULL
//       )";

// if ($db_conn->query($sql_tickets) === TRUE) {
//   echo "ticket table created successfully";

// }
//           echo "Users and contact table created successfully";

//         }
// } else {
// echo "Error creating table: " . $db_conn->error;
// }



// $db_conn->close();
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
    echo "Email Id Already Exists"; 
    http_response_code(203);
	exit;
}

    else if(filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
        $insertUser = mysqli_query($db_conn, "INSERT INTO `users`(`firstname`,`lastname`,`googleid`,`email`, `phonenumber`, `companyname`) VALUES('$userfirstname','$userlastname', '$usergoogleid','$useremail', '$userphonenumber', '$usercompanyname')");
        if ($insertUser) {
            $last_id = mysqli_insert_id($db_conn);
            echo json_encode(["success" => 1, "msg" => "User Inserted.", "id" => $last_id]);
            http_response_code(201);



            
              
           
              echo "Table Users with Contacts are both created successfully";
              $sampleone = mysqli_query($db_conn, "INSERT INTO Contact (contactid, firstname, lastname, email, phonenumber, companyname) VALUES ($last_id,'Mark', 'Demolowski (Sample)', 'dmark@gmail.com', '(203)-424-2456', 'Stratford Board of Education')");
              if ($db_conn->query($sampleone) === TRUE) {
                echo "New sample data created successfully";
              } else {
                echo "Error: " . $sampleone . "<br>" . $conn->error;
              }

              $sampletwo = mysqli_query($db_conn, "INSERT INTO Contact (contactid, firstname, lastname, email, phonenumber, companyname) VALUES ($last_id,'Martin', 'Muniz (Sample)', 'mmartin@gmail.com', '(203)-746-8645', 'General Electric')");
              if ($db_conn->query($sampleone) === TRUE) {
                echo "New sample data created successfully";
              } else {
                echo "Error: " . $sampleone . "<br>" . $conn->error;
              }
              

        } else {
            echo json_encode(["success" => 0, "msg" => "User Not Inserted!"]);
        }
    } else {
        echo json_encode(["success" => 0, "msg" => "Invalid Email Address!"]);
    }
} else {
    echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
}