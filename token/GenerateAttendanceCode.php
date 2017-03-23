<?php

/*
  @copyright (c) 2017, Daniel Quah
  @author Daniel Quah
  @license AGPL-3.0
  This code is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License, version 3,
  as published by the Free Software Foundation.
 
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU Affero General Public License for more details.
 
  You should have received a copy of the GNU Affero General Public License, version 3,
  along with this program.  If not, see <http://www.gnu.org/licenses/>
 
 
*/

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

echo getAttendanceCode(256)

?>

