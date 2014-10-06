<?php

return array(
    'phpSettings' => array(
        'display_startup_errors' => 1, 
        'display_errors' => 1, 
        'date' => array(
            'timezone' => 'Europe/Paris'
        )
    ), 
    'resources' => array(
        'db' => array(
            'adapter' => 'PDO_SQLITE', 
            'params' => array(
                'dbname' => APPLICATION_PATH . '/data/todos.db'
            )
        ), 
        'log' => array(
            'syslog' => array(
                'writerName' => 'Syslog', 
                'writerParams' => array(
                    'application' => 'todo'
                ), 
                'formatterName' => 'Simple', 
                'formatterParams' => array(
                    'format' => '[%priorityName%] %message%'
                ), 
                'filterName' => 'Priority', 
                'filterParams' => array(
                    'priority' => Zend_Log::DEBUG
                )
            )
        )
    )
);
