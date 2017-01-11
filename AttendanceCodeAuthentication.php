<?php

	define('HOST', 'localhost');
	define('USER, 'root')
	define('PASS', 'hunter2');
	define('DB', 'ats_attendance');
	
	$con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');