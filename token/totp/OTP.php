<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use OTPHP\TOTP;

$secretfile = fopen("secret.txt","r") or die("Unable to open file! Did you create secret.txt?");


$totp = new TOTP(
    "PAS",
    $secret,
    20,
    'sha512',
    8
);

$totp ->setIssuer('Proximity Attendance System');
echo "Current OTP: " , $totp->now() , PHP_EOL;

fclose($secretfile);
?>
