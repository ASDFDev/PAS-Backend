<?php
if($_SERVER['REQUEST_METHOD']=='POST'){

 require 'auth/AttendanceAuth.php';

 $device_id = $_POST['device_id'];
 $username = $_POST['username'];
 $attendance_code = $_POST['attendance_code'];

 if($device_id == '' || $username == '' || $attendance_code == ''){
     // Bad Request
     http_response_code(400);
     $response["Operation"] = "Attendance submission";
     $response["Result"] = "Failed!";
     $response["Reason"] = "Missing input";
     return json_encode($response);
 }else {
         $sql = "SELECT * FROM ats WHERE device_id='$device_id' OR username='$username'";

         $check = mysqli_fetch_array(mysqli_query($con, $sql));

         if (isset($check)) {
             // Too Many Requests
             http_response_code(429);
             $response["Operation"] = "Attendance submission";
             $response["Result"] = "Failed!";
             $response["Reason"] = "You have already submitted attendance code for this lesson!";
             return json_encode($response);
         } else {

             $sql = "INSERT INTO ats (device_id,username,attendance_code) VALUES('$device_id','$username','$attendance_code')";

             if (mysqli_query($con, $sql)) {
                 // OK
                 http_response_code(200);
                 $response["Operation"] = "Attendance submission";
                 $response["Result"] = "Successful!";
                 return json_encode($response);
             } else {
                 // Internal Server Error
                 http_response_code(500);
             }

         }
         mysqli_close($con);
     }
}
else{
    // User is not using POST
    // Method not allowed
	http_response_code(405);
    $response["Operation"] = "Database connection";
    $response["Result"] = "Unable to connect to database.";
    $method = $_SERVER['REQUEST_METHOD'];
    $response["Reason"] = "You are using: " . $method . "Please use POST instead.";
    return json_encode($response);
}