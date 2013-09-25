<?php
namespace Todo\Infrastructure;

use Todo\Model\Repositories;

class ZendDbRepositories extends Repositories
{
    private $todoRepository;

    public function __construct($db)
    {
        $this->todoRepository = new ZendDbTodoRepository($db);
    }

    protected function _getTodoRepository()
    {
        return $this->todoRepository;
    }
}