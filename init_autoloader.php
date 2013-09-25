<?php

// Composer autoloading
if (file_exists('vendor/autoload.php')) {
    include 'vendor/autoload.php';
}

if (!class_exists('Zend_Loader_AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF. Run `php composer.phar install`.');
}

Zend_Loader_AutoloaderFactory::factory(
    array(
        'Zend_Loader_ClassMapAutoloader' => array(
            __DIR__ . '/application/autoload_classmap.php', 
            __DIR__ . '/library/autoload_classmap.php'
        )
    ));
