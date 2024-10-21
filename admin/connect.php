<?php
require_once '../libs/Database.class.php';

$params		= [
	'server' 	=> 'localhost',
	'username'	=> 'root',
	'password'	=> '',
	'database'	=> 'ZEND_DEMO',
	'table'		=> 'rss',
];

$database = new Database($params);
