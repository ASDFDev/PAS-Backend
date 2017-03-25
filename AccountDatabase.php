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



require 'auth/AccountAuth.php';

$username = $_POST['username'];
$password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if($username == '' || $password == ''){
        // Bad Request
        http_response_code(401);
        $response["Operation"] = "Account Authentication";
        $response["Result"] = "Failed!";
        $response["Reason"] = "Missing input";
        return json_encode($response);

} else {

    if(strpos($username, 'p') !== false){
        // Is student
        $sql = "SELECT * FROM students WHERE username = '$username' and password = '$password' ";
        $count = mysqli_num_rows($sql);
        $response["Operation"] = "Account Authentication";
        $response["Result"] = "Success!";
        return json_encode($response);
    } else if(strpos($username, 's') !== false){
        // Is lecturer
        $sql = "SELECT * FROM lecturers WHERE username = '$username' and password = '$password' ";
        $count = mysqli_num_rows($sql);
        $response["Operation"] = "Account Authentication";
        $response["Result"] = "Success!";
        require_once('GenerateAttendanceCode.php');
        $response["Code"] = $hex;
        return json_encode($response);
    } else{
        // Account is not in database
        $response["Operation"] = "Account Authentication";
        $response["Result"] = "Fail! Invalid user login.";
        return json_encode($response);
    }

}

} else {
    // User is not using POST
    // Method not allowed
    http_response_code(405);
    $response["Operation"] = "Database connection";
    $response["Result"] = "Unable to connect to database.";
    // nasty hack
    $a = "You are using: ";
    $b = $_SERVER['REQUEST_METHOD'];
    $c = "Please use POST instead.";
    $response["Reason"] = $a . $b . $c;
    return json_encode($response);
}
