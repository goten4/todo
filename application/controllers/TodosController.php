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
}
