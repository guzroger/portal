<?php

$db_host = getenv('MYSQL_HOST', true) ?: getenv('MYSQL_HOST');
$db_name = getenv('MYSQL_DATABASE', true) ?: getenv('MYSQL_DATABASE');
$db_user = getenv('MYSQL_USER', true) ?: getenv('MYSQL_USER');
$db_pwd  = getenv('MYSQL_PASSWORD', true) ?: getenv('MYSQL_PASSWORD');

// This is the database connection configuration.
return array(
	'class'=>'CDbConnection',
	//ACCESO OFICIAL
		'connectionString' => 'mysql:host='. $db_host . ';dbname=' . $db_name,
	//ACCESO PRUEBA
		//'connectionString' => 'mysql:host=192.168.203.40;dbname=test_intranet',
		'emulatePrepare' => true,
		'username' => $db_user,
		'password' => $db_pwd,
		'charset' => 'utf8',

);