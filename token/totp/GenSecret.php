<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Base32\Base32;

$secret = random_bytes(256);
$encoded_secret = Base32::encode($secret);
$encoded_secret = substr($encoded_secret,0,16);


file_put_contents('secret.txt',$encoded_secret);

?>

