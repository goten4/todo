<?php

use Todo\Presentation\BaseController;
use Todo\Model\Repositories;
use Todo\Model\Todo;

class TodosController extends BaseController
{

    public function indexAction()
    {
        $this->view->todos = Repositories::todos()->getAll();
    }

    public function newAction()
    {
    }

    public function createAction()
    {
        if ($this->hasParam('description')) {
            Repositories::todos()->add(new Todo($this->getParam('description')));
        }
        $this->redirect('/todos');
    }

    public function editAction()
    {
        if (!$this->hasParam('id')) {
            return $this->notFound();
        }
        $this->view->todo = Repositories::todos()->getById($this->getParam('id'));
        if ($this->view->todo === null) {
            return $this->notFound();
        }
    }

    public function updateAction()
    {
        if (!$this->hasParam('id')) {
            return $this->notFound();
        }
        $todo = Repositories::todos()->getById($this->getParam('id'));
        if ($todo === null) {
            return $this->notFound();
        }
        
        if ($this->hasParam('description')) {
            Repositories::todos()->update($todo->setDescription($this->getParam('description')));
        }
        $this->redirect('/todos');
    }
}
