<?php
namespace Todo\Infrastructure;

use Todo\Model\Todo;

class ZendDbTodoRepository extends ZendDbRepository
{
    const SQL_DATE_FORMAT = 'Y-m-d H:i:s';

    protected function _tableName()
    {
        return 'todos';
    }

    protected function _tableAlias()
    {
        return 't';
    }

    protected function _createEntity($sqlRow)
    {
        $entity = new Todo($sqlRow['description']);
        $entity->setId($sqlRow['id']);
        $entity->setCreatedAt(new \DateTime($sqlRow['created_at']));
        return $entity;
    }

    protected function _sqlArray($entity)
    {
        return array(
            'id' => $entity->getId(), 
            'description' => $entity->getDescription(), 
            'created_at' => $entity->getCreatedAt()->format(self::SQL_DATE_FORMAT)
        );
    }
}
