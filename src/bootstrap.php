<?php

// TODO: stop using BASEPATH or remove it from this file
define('BASE_PATH', substr(dirname(__FILE__), 0, -4));

$file = __DIR__ . '/../vendor/autoload.php';
$loader = file_exists($file) ? require $file : false;
if (!$loader)
{
	echo PHP_EOL . 'Please run ./configenv in the project root directory' . PHP_EOL . PHP_EOL;
	exit(1);
}

return $loader;
