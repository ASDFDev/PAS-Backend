<?php

	define('HOST','localhost');
	define('USER', 'root');
	define('PASS', 'hunter2');
	define('DB', 'ats_attendance');
	
	$con = mysqli_connect(HOST,USER,PASS,DB);

	if(!$con){
	    die('Error connecting to server: ' . mysqli_connect_error());
    }
