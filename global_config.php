<?php
	date_default_timezone_set('America/Chicago');
	
	//Configuration array that holds the names of Database login information, table names, and page urls
	$config['base_url'] =			'/CMI-Website/';
	$config['home_url'] =			$config['base_url'].'Homepage/';
	$config['gallery_url'] =		$config['base_url'].'Gallery/';
	$config['calender_url'] =		$config['base_url'].'Calender/';
	$config['admin_url'] =			$config['base_url'].'Admin/';

	//login credentials
	$config['db']['username'] =		'Badger';
	$config['db']['password'] =		'cMiBAdgeR13#';
	$config['db']['hostname'] =		'localhost';
	$config['db']['database'] =		'cmimadison';

	//define table names
	$config['db']['users'] =		'users';
	$config['db']['contact'] =		'contact_info';
	$config['db']['photo_lib']=		'photo_library';
	//$config['db']['photo_info']=	'photo_info';
	$config['db']['albums']=		'albums';
	$config['db']['credentials']=	'credentials';

	//require user class?

	//Initialize MySQL
	$mysqli = new mysqli($config['db']['hostname'], $config['db']['username'], $config['db']['password'], $config['db']['database']);
	if($mysqli->connect_errno){
		die("Failed to connect to MySQL: (" . $mysqli->connecterrno . ") " . $mysqli->connect_errno);
	}
