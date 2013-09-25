<?php
namespace Todo\Model;

interface Repository
{
    public function getAll();
    public function size();
    public function getById($id);
    public function add($entity);
    public function addAll($entities);
    public function update($entity);
    public function remove($entity);
    public function removeAll($entities = null);
}
