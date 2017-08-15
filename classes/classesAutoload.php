<?php
function classesAutoload($classname){
    //Can't use __DIR__ as it's only in PHP 5.3+
    $filename = dirname(__FILE__).DIRECTORY_SEPARATOR.''.strtolower($classname).'.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    //SPL autoloading was introduced in PHP 5.1.2
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register('classesAutoload', true, true);
    } else {
        spl_autoload_register('classesAutoload');
    }
} else {
    /**
     * Fall back to traditional autoload for old PHP versions
     * @param string $classname The name of the class to load
     */
    function __autoload($classname)
    {
        classesAutoload($classname);
    }
}

	/* Examples: */
require_once "constants.php";
require_once "lang/en.php";
require_once "db.php";
/************************************************************
**                        MYSQLi                          **
************************************************************/
/* connection info */
$DB_TYPE_MYSQL = DB_TYPE;       /* Type of connection */
$DB_HOST_MYSQL = DB_HOST;     /* Host */
$DB_PORT_MYSQL = DB_PORT;       /* db port */
$DB_NAME_MYSQL = DB_NAME;       /* database name */
$DB_USER_MYSQL = DB_USER;     /* user name */
$DB_PASS_MYSQL = DB_PASS;     /* password */


/* create the connection */
$MYSQL = new db($DB_TYPE_MYSQL,$DB_HOST_MYSQL,$DB_NAME_MYSQL,$DB_USER_MYSQL,$DB_PASS_MYSQL,$DB_PORT_MYSQL); 


?>
