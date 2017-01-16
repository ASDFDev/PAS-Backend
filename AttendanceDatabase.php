<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $device_id = $_POST['device_id'];
 $username = $_POST['username'];
 $attendance_code = $_POST['attendance_code'];
 
 if($device_id == '' || $username == '' || $attendance_code == ''){
     echo 'Fatal error! Empty input!';
     // Bad Request
     http_response_code(400);
 }else{
 
 require_once('AttendanceCodeAuthentication.php');
 
 $sql = "SELECT * FROM ats WHERE device_id='$device_id' OR username='$username'";
 
 $check = mysqli_fetch_array(mysqli_query($con,$sql));
 
 if(isset($check)){

     echo 'You have already submitted attendance code for this lesson!';
     // Too Many Requests
     http_response_code(429);
 }else{

 $sql = "INSERT INTO ats (device_id,username,attendance_code) VALUES('$device_id','$username','$attendance_code')";
 
 if(mysqli_query($con,$sql)){

	echo 'Attendance submitted!';
	// OK
    http_response_code(200);
 }else{
	echo 'An error has occured, please try again!';
    // Internal Server Error
	http_response_code(500);
 }
 
	}
	mysqli_close($con);
	}
  }
else{
	echo 'Error, unable to connect to database.';
    // User is not using POST
    // Method not allowed
	http_response_code(405);
}