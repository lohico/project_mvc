<?php
//Starting Session pt toate paginile:
session_start();

//Require config file, autoload classes, helpers_functions
require_once('config/config.php');

//helper functions files:
require_once('helpers/system_helper.php');
require_once('helpers/db_helper.php');
require_once('helpers/format_helper.php');

//Autoload Classes:
function __autoload($class_name){
	require_once('libraries/'.$class_name.'.php');

}


?>