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

require_once __DIR__ . '/vendor/autoload.php';

use Base32\Base32;

$secret = random_bytes(256);
$encoded_secret = Base32::encode($secret);
$encoded_secret = substr($encoded_secret,0,16);


file_put_contents('secret.txt',$encoded_secret);

?>

