# PAS Backend

This REST API is written for Proximity Attendance System. Software using this API

* [PAS-Quiet-Android](https://github.com/Proximity-Attendance-System/PAS-Quiet-Android)
* [PAS-Quiet-iOS](https://github.com/Proximity-Attendance-System/PAS-Quiet-iOS)


## Software Requirement

> Note: I am using a LAMP stack, WAMP stack is no longer supported. 

* MariaDB
* php7
* phpMyAdmin(Optional)
* Apache
* composer

Place all files inside `/var/www/html/` and we are *almost* ready to go. 

## Setting up the DB

This authentication used for this project is insecure by default(I'm using it behind my network, so it's ok for me). Make sure you change the username and password in [auth/AttendanceCodeAuthentication.php](auth/AttendanceCodeAuthentication.php). 

1. Create a database named `pas` with 2 tables named `attendance` and `accounts`. 
2. Inside `attendance`, there should be 3 fields(`device_id`, `username` and `attendance_code`). 
3. Inside `accounts`, there should be 3 fields(`username` , `password` and `role`).

## Setting up using composer
```bash
$ composer require spomky-labs/otphp
$ composer require symfony/polyfill-php70
```

## Getting your attendance code 2 different ways
1. Through pseudo-randomness[(/dev/urandom)](token/GenerateAttendanceCode.php)
2. Through Time Based One Time Password(Read on if you are using this)

## Generate your own secret
```bash
$ php token/totp/GenSecret.php

Secret Key: XICHOBVO3OM5MSGL
```

## Reading Server Output

You can either read the server output by reading http_response_code or through json output.


 
