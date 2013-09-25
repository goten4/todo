<?php

return array(
    'config' => array(
        'environment' => APPLICATION_PATH . '/configs/environment.config.php'
    ), 
    'bootstrap' => array(
        'path' => APPLICATION_PATH . '/Bootstrap.php', 
        'class' => 'Bootstrap'
    ), 
    'appnamespace' => 'Application', 
    'resources' => array(
        'frontController' => array(
            'controllerDirectory' => APPLICATION_PATH . '/controllers', 
            'defaultControllerName' => 'todos'
        ), 
        'view' => array(
            'basePath' => APPLICATION_PATH . "/views"
        ), 
        'layout' => array(
            'layoutPath' => APPLICATION_PATH . "/views/layouts/scripts"
        )
    )
);