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


require_once __DIR__ . '/vendor/autoload.php';

function getAttendanceCode()
{
        $open_secretfile = fopen("secret.txt", "r");
        $secret = fgets($open_secretfile);
// 8 digit code with SHA512 digest valid for 20s using secrets.txt as a seed
        $totp = new TOTP(
            "Setsuna",
            $secret,
            20,
            'sha512',
            8
        );
        $code = $totp->now();
        fclose($open_secretfile);

       echo $code;
       return $code;
}




?>
