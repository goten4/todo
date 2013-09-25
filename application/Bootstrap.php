<?php
use Todo\Model\Repositories;
use Todo\Infrastructure\ZendDbRepositories;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initOptions()
    {
        Zend_Registry::set('options', $this->_options);
    }

    protected function _initPlaceholders()
    {
        $this->bootstrap('View');
        $view = $this->getResource('View');
        $view->headTitle('Todo')->setSeparator(' - ');
    }

    protected function _initDatabase()
    {
        $this->bootstrap('db');
        Repositories::initialize(new ZendDbRepositories($this->getResource('db')));
    }

    protected function _initLogger()
    {
        $this->bootstrap('log');
        Zend_Registry::set('logger', $this->getResource('log'));
    }
}
