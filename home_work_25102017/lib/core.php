<?php

error_reporting(0);

spl_autoload_register(function ($name) {
	$name = str_replace('\\', DS, $name);
	include_once $name . '.php';
});