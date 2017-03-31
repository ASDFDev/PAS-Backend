<?php

/**
 * @copyright (c) 2017, ASDF Development
 * @author Daniel Quah
 * @license AGPL-3.0
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

session_start();

$username = $_POST['username'];
$password = $_POST['password'];
$role_value = $_POST['role_selection'];

require 'auth/AccountAuth.php';

if ($username == '' || $password == ''){
    http_response_code(400);
    $response["Operation"] = "Sign In";
    $response["Result"] = "Failed!";
    $response["Reason"] = "Missing input!";
    echo json_encode($response);
} else {
  $staff = "SELECT * FROM staff WHERE username='$username' AND password='$password'";
  $student = "SELECT * FROM student WHERE username='$username' AND password='$password'";
  $check_staff = mysqli_fetch_array(mysqli_query($con,$staff));
  $check_student = mysqli_fetch_array(mysqli_query($con,$student));

  if($role_value == "staff"){
        if(isset($check_staff)){
            //Valid staff account
            $_SESSION["Role"] = "Lecturer";
            header("location: /SubmitAttendance.php");
        } else {
            // Invalid Staff account
            http_response_code(401);
            $response["Operation"] = "Sign In";
            $response["Result"] = "Failed!";
            $response["Reason"] = "Invalid Credentials!";
            echo json_encode($response);
            header("location: /error.html");
        }
 } else {
     if(isset($check_student)){
         //Valid student account
         $_SESSION["Role"] = "Student";
         header("location: /GetAttendanceCode.php");
     } else{
         // Invalid student account
         http_response_code(401);
         $response["Operation"] = "Sign In";
         $response["Result"] = "Failed!";
         $response["Reason"] = "Invalid Credentials!";
         echo json_encode($response);
         header("location: /error.html");

     }
 }
  mysqli_close($con);
}

?>