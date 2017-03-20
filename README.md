# ATS Backend

This REST API is written to be used in conjuction with [PAS-Quiet-Android](https://github.com/Proximity-Attendance-System/PAS-Quiet-Android). The setup assumes you have the neccessary system and database adminstration skills. 

## Software Requirement

> Note: I am using a LAMP stack, you may use a WAMP stack if you wish.

* MariaDB(You may use other DB, however, they are not supported)
* php≥5
* phpMyAdmin(Optional)
* Apache

Place all php files inside `/var/www/html/` and we are *almost* ready to go. 

## Setting up the DB

This authentication used for this project is insecure by default(I'm using it behind my network, so it's ok for me). Make sure you change the username and password in AttendanceCodeAuthentication.php. 

1. Create a database named `pas` with 2 tables named `attendance` and `accounts`. 
2. Inside `attendance`, there should be 3 fields(`device_id`, `username`, `attendance_code`). 
3. Inside `accounts`, there should be 2 fields(`username` and `password`).

## Reading Server Output

You can either read the server output by reading http_response_code or through json output.
