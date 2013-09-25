<?php

// Define path constants
defined('BASE_PATH') || define('BASE_PATH', dirname(__DIR__));
defined('APPLICATION_PATH') || define('APPLICATION_PATH', BASE_PATH . '/application');

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(BASE_PATH);

// Setup autoloading
include 'init_autoloader.php';

// Create application, bootstrap, and run
$application = new Zend_Application(null, APPLICATION_PATH . '/configs/application.config.php');
$application->bootstrap()->run();