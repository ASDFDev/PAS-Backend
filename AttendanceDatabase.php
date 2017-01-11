<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
 
 $device_id = $_POST['device_id'];
 $username = $_POST['username'];
 $attendance_code = $_POST['attendance_code'];
 
 if($device_id == '' || $username == '' || $attendance_code == ''){

 }else{
 
 require_once('AttendanceCodeAuthentication.php');
 
 $sql = "SELECT * FROM ats WHERE device_id='$device_id' OR username='$username'";
 
 $check = mysqli_fetch_array(mysqli_query($con,$sql));
 
 if(isset($check)){

 echo 'You have already submitted attendance code for this lesson!';

 }else{

 $sql = "INSERT INTO ats (device_id,username,attendance_code) VALUES('$device_id','$username','$attendance_code')";
 
 if(mysqli_query($con,$sql)){

	echo 'Attendance submitted!';

 }else{
	echo 'An error has occured, please try again!';
 }
 
	}
	mysqli_close($con);
	}
  }
	else{
	echo 'Error, unable to connect to database.';
}