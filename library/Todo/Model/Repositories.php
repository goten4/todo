<?php
namespace Todo\Model;

/**
 * Class used to get Repositories instances
 */
abstract class Repositories
{
    private static $_instance;

    public static function initialize(Repositories $repositories)
    {
        self::$_instance = $repositories;
    }

    public static function instance()
    {
        return self::$_instance;
    }

    public static function todos()
    {
        return self::$_instance->_getTodoRepository();
    }

    protected abstract function _getTodoRepository();
}