# ATS Backend

This REST API is written to be used in conjuction with [ATS reboot](https://github.com/emansih/sp_ats_reboot). The setup assumes you have the neccessary system and

database adminstration skills. 

## Software Requirement

> Note: I am using a LAMP stack, you may use a WAMP stack if you wish.

* MariaDB(You may use other DB, however, they are not supported)
* phpMyAdmin(Optional)

Place all php files inside `/var/www/html/` and we are *almost* ready to go. 

## Setting up the DB
This authentication used for this project is insecure by default(I'm using it behind my network, so it's ok for me). Make sure you change the username and password in AttendanceCodeAuthentication.php. 

Create a database named `ats_attendance` and a table named `ats`. Inside the table, there should be 3 fields(`device_id`, `username`, `attendance_code`). 