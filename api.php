<?php
	define('APP_PATH', dirname(__FILE__)."/Application/");
	define('Core_PATH', dirname(__FILE__)."/WoldyPHP/phpCore/");
	require_once(Core_PATH.'Woldy.class.php');
	$app=new Woldy();
	$app->init();

	exit;
