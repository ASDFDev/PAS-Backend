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

require 'auth/AccountAuth.php';

if ($username == '' || $password == ''){
    http_response_code(400);
    $response["Operation"] = "Sign In";
    $response["Result"] = "Failed!";
    $response["Reason"] = "Missing input!";
    echo json_encode($response);
} else {
  $sql = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
  $check = mysqli_fetch_array(mysqli_query($con,$sql));

  if(isset($check)){
      //Valid user
       header("location: http://google.com");
   }
   else{
      //Invalid user
      echo "Username or Password is invalid";
      header("location:http://facebook.com");
  }
  mysqli_close($con);
}

?>