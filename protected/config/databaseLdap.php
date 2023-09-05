<?php

// This is the database connection configuration.
return array(
	//'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	// uncomment the following lines to use a MySQL database
	/*
	'connectionString' => 'mysql:host=localhost;dbname=testdrive',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	*/
	'class'=>'ext.oci8Pdo.OciDbConnection',
    //'connectionString'=>'oci:dbname=BGP1.world',
    'connectionString'=>'oci:dbname=(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.9.200.204)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = DB1) (SID = DB1)));charset=AL32UTF8',
	'username'=>'ldap',
    'password'=>'comteco',
	'enableProfiling' => true,
	'enableParamLogging' => true,
);