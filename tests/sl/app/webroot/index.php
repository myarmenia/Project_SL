<?php
/*
 * Directory separator
 * string
 */
define('DS',DIRECTORY_SEPARATOR);
/*
 * Path to app
 * string
 */
define('APP_PATH',realpath('../'));
/*
 * Path to core
 * string
 */
define('CORE_PATH',realpath('../../core'));

ini_set ('display_errors', 1);

session_start();

/*
 * Set include paths
 * app/webroot/classes
 * app/core/classes
*/

$includePats = array(
    APP_PATH . DS . 'classes',
    CORE_PATH . DS . 'classes',
    APP_PATH . DS . 'controllers',
    APP_PATH . DS . 'models',
    APP_PATH . DS . 'language',
    get_include_path()
);

$includePats = implode(PATH_SEPARATOR,$includePats);
set_include_path($includePats);
 /*
  * database configuration
  */
// require_once 'config.php';

// require_once 'bootstrap.php';

// function __autoload($class_name) {
//     $filename = strtolower($class_name) . '.php';
//     include ($filename);
// }




function autoloader(string $class_name) {
    $filename = strtolower($class_name) . '.php';
    require_once $filename;
}

spl_autoload_register('autoloader');

require_once 'config.php';

require_once 'bootstrap.php';


