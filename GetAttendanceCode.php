<?php

//TODO: Each student should use their own seed possibly through rng.

$AttendanceCode = new AttendanceCode();
$code = $AttendanceCode->getAttendanceCode();

echo $code;

?>