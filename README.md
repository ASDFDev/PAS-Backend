# ATS Backend

This REST API is written to be used in conjuction with [PAS-Quiet-Android](https://github.com/Proximity-Attendance-System/PAS-Quiet-Android). The setup assumes you have the neccessary system and database adminstration skills. 

## Software Requirement

> Note: I am using a LAMP stack, WAMP stack is no longer supported. 

* MariaDB
* php7
* phpMyAdmin(Optional)
* Apache
* composer

Place all php files inside `/var/www/html/` and we are *almost* ready to go. 

## Setting up the DB

This authentication used for this project is insecure by default(I'm using it behind my network, so it's ok for me). Make sure you change the username and password in AttendanceCodeAuthentication.php. 

1. Create a database named `pas` with 2 tables named `attendance` and `accounts`. 
2. Inside `attendance`, there should be 3 fields(`device_id`, `username`, `attendance_code`). 
3. Inside `accounts`, there should be 2 fields(`username` and `password`).

## Setting up using composer
```bash
$ composer require spomky-labs/otphp
$ composer require symfony/polyfill-php70
```

## Getting your attendance code 2 different ways
1. Through pseudo-randomness[(/dev/urandom)](token/GenerateAttendanceCode.php)
2. Through Time Based One Time Password(Read on if you are using this)

## Generate your own secret
First we have to generate our own secret key
```bash
$ php token/totp/GenSecret.php

Secret Key: XICHOBVO3OM5MSGL
```
This secret key will appear only **once**. Go to token/totp/OTP.php and find `"xxxx" // Input your secret key here!`.
Replace xxxx with your key. 

## Reading Server Output

You can either read the server output by reading http_response_code or through json output.


 
