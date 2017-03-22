<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use OTPHP\TOTP;

$totp = new TOTP(
    "Proxmity Attendance System", 
    "xxxx" // Input your secret key here!
);

$totp ->setIssuer('PAS');
echo "Current OTP: " , $totp->now() , PHP_EOL;


