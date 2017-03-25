<?php

/*
  @copyright (c) 2017, ASDF Development
  @author Daniel Quah
  @license AGPL-3.0
  This code is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License, version 3,
  as published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License, version 3
  along with this program.  If not, see <http://www.gnu.org/licenses/>

*/
use OTPHP\TOTP;

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    require_once __DIR__ . 'vendor/autoload.php';
    $secretfile = 'secret.txt';
    if (file_exists($secretfile)) {

        $open_secretfile = fopen("secret.txt", "r");
        $secret = fgets($open_secretfile);

        $totp = new TOTP(
            "PAS",
            $secret,
            20,
            'sha512',
            8
        );

        $totp->setIssuer('Setsuna');
        $response["Operation"] = "Retrieving attendance code";
        $response["Result"] = $totp->now();
        $response["Method"] = "Time based";
        echo json_encode($response);

        fclose($open_secretfile);
    } else {

        $response["Operation"] = "Retrieving attendance code";
        $response["Result"] = getAttendanceCode(256);
        $response["Method"] = "/dev/urandom";
        echo json_encode($response);

    }

} else {
    http_response_code(405);
    $response["Operation"] = "Retrieving attendance code";
    $response["Result"] = "Unable to process";
    $method = $_SERVER['REQUEST_METHOD'];
    $response["Reason"] = "You are using: " . $method . ".Please use GET instead.";
    echo json_encode($response);

}


function getAttendanceCode($bytes)
{
    $readUrandom = @fopen('/dev/urandom','rb');
    $attendanceCode = '';
    if ($readUrandom !== FALSE) {
        $attendanceCode .= @fread($readUrandom, $bytes);
        @fclose($readUrandom);
    }
    else
    {
        trigger_error('Insufficient entropy!');
    }

    // Convert to string from binary
    $attendanceCode = base64_encode($attendanceCode);

    // remove none url chars
    $attendanceCode = strtr($attendanceCode, '+/', '-_');

    // Remove "=" from string
    $attendanceCode = str_replace('=', ' ', $attendanceCode);

    // Get the first 10 char from urandom
    $attendanceCode = substr($attendanceCode,0,10);

    return $attendanceCode;
}

?>
