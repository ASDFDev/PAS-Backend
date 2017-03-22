<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use OTPHP\TOTP;

$totp = new TOTP(
    "PAS",
    "xxx", // Input your secret key here!
    20,
    'sha512',
    8
);

$totp ->setIssuer('Proximity Attendance System');
echo "Current OTP: " , $totp->now() , PHP_EOL;
