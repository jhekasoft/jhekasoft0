<?php
/**
 * Display all errors when APPLICATION_ENV is development.
 */
if ($_SERVER['APPLICATION_ENV'] == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// Set timezone
if (function_exists('date_default_timezone_set')) {
	date_default_timezone_set('Europe/Kiev');
}

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
