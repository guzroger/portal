<?php

// This is the database connection configuration.
return array(
	
	'class'=>'CDbConnection',
	//LOCAL
	/*'connectionString' => 'mysql:host=localhost;dbname=consultorio',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/
	//ACCESO OFICIAL
		'connectionString' => 'mysql:host=192.168.203.40;dbname=oficial_consultorio',
	//ACCESO PRUEBA
		//'connectionString' => 'mysql:host=192.168.203.40;dbname=test_consultorio',
		'emulatePrepare' => true,
		'username' => 'ecuevas',
		'password' => 'Comt3c0',
		'charset' => 'utf8',
	
);