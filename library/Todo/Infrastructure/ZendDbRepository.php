<?php
namespace Todo\Infrastructure;

use Todo\Model\Repository;

abstract class ZendDbRepository implements Repository
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function getAll()
    {
        return $this->_getAllFromSelect($this->_getSelect());
    }

    public function getAllBy($criteria)
    {
        return $this->_getAllFromSelect($this->_getSelectWithCriteria($criteria));
    }

    protected function _getAllFromSelect($select)
    {
        $entities = array();
        $sqlResult = $this->getDb()->fetchAll($select);
        foreach ($sqlResult as $sqlRow) {
            $entities[] = $this->_createEntity($sqlRow);
        }
        return $entities;
    }

    public function size()
    {
        $select = $this->getDb()->select()->from($this->_tableName(), 'COUNT(*)');
        return $this->getDb()->fetchOne($select);
    }

    public function getBy($criteria)
    {
        $sqlRow = $this->getDb()->fetchRow($this->_getSelectWithCriteria($criteria));
        return $sqlRow ? $this->_createEntity($sqlRow) : null;
    }

    public function getById($id)
    {
        return $this->getBy(array(
            $this->_id() => $id
        ));
    }

    public function add($entity)
    {
        $this->getDb()->insert($this->_tableName(), $this->_sqlArray($entity));
        if ($entity->getId() == null) {
            $entity->setId($this->getDb()->lastInsertId());
        }
    }

    public function addAll($entities)
    {
        foreach ($entities as $entity) {
            $this->add($entity);
        }
    }

    public function update($entity)
    {
        $this->getDb()->update($this->_tableName(), $this->_sqlArray($entity), array(
            $this->_id() . ' = ?' => $entity->getId()
        ));
    }

    public function remove($entity)
    {
        $this->getDb()->delete($this->_tableName(), array(
            $this->_id() . ' = ?' => $entity->getId()
        ));
    }
    
    public function removeAll($entities = null)
    {
        $where = "";
        if ($entities != null) {
            $identifiers = array_map(function ($entity) { return $entity->getId(); }, $entities);
            $where = $this->getDb()->quoteInto($this->_id() . ' IN (?)', $identifiers);
        }
		$this->getDb()->delete($this->_tableName(), $where);
    }
    
    public function getDb()
    {
        return $this->_db;
    }

    public function getConnection()
    {
        return $this->getDb()->getConnection();
    }

    public function setDb($db)
    {
        $this->_db = $db;
    }

    protected function _getSelect()
    {
        return $this->getDb()->select()->from(array(
            $this->_tableAlias() => $this->_tableName()
        ));
    }

    protected function _id()
    {
        return 'id';
    }

    protected abstract function _tableName();

    protected abstract function _tableAlias();

    protected abstract function _createEntity($sqlRow);

    protected abstract function _sqlArray($entity);

    protected function _getSelectWithCriteria($criteria)
    {
        $select = $this->_getSelect();
        foreach ($criteria as $field => $value) {
            $select->where($this->_tableAlias() . ".$field = ?", $value);
        }
        return $select;
    }
}