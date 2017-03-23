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

  You should have received a copy of the GNU Affero General Public License, ver$
  along with this program.  If not, see <http://www.gnu.org/licenses/>

*/

require_once __DIR__ . '/../../vendor/autoload.php';

use OTPHP\TOTP;

$secretfile = fopen("secret.txt","r") or die("Unable to open file! Did you create secret.txt?");
$secret = fgets($secretfile);

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
