<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Tab;
use Modules\Controllers\AdminController;

class TabsController extends AdminController
{
    public $php_self = 'tabs';

    public function indexAction($id_parent = 0)
    {
        $modules = Modules::find(
            [
                "conditions" => "id_parent = :id:",
                "order" => "position, id_modules",
                "bind"       => [
                    'id' => (int)$id_parent
                ]
            ]
        )->toArray();

        $this->view->setVar("id_parent", $id_parent);
        $this->view->setVar("modules", $modules);
    }

    public function editAction($id_modules)
    {
        $module = Modules::findFirst($id_modules);

        if(!$module) {
            $this->response->redirect(["for" => "backend-404"]);
            return false;
        }
        $this->setParents();

        $this->view->setVar("module", $module);
        if ($this->request->isPost()) {
            $this->_makeItem($this->request->getPost('id_modules'));
        }
    }

    public function addAction($id_parent = 0)
    {
        $this->view->setVar("id_parent", $id_parent);
        $this->setParents();
        if ($this->request->isPost()) {
            $this->_makeItem();
        }

    }

    public function deleteAction()
    {
        $id_modules = $this->request->getPost('id');
        if(!is_array($id_modules))
            $id_modules = array($id_modules);

        foreach ($id_modules as $id_module) {
            $module = Modules::findFirst($id_module);
            if ($module->delete() === true) {

                parent::positionOnDelete(new Modules(), $id_module);
                $children = Modules::find(
                    [
                        "conditions" => "id_parent = :id:",
                        "order" => "id_modules",
                        "bind"       => [
                            'id' => (int)$id_module
                        ]
                    ]
                )->toArray();

                if($children) {
                    foreach ($children as $c) {
                        $_POST['id_modules'] = $c['id_modules'];
                        $this->deleteAction();
                    }
                }
            }
        }
        die(true);
    }

    public function statusAction($active) {
        parent::changeStatus($active, new Modules());
    }

    protected function _makeItem($id = false) {
        if($id)
            $object = Modules::findFirst($id);
        else
            $object = new Modules();

        $object->name = $this->request->getPost('name');
        $object->link_rewrite = $this->request->getPost('link_rewrite');
        $object->action = $this->request->getPost('action');
        $object->icon = $this->request->getPost('icon');
        $object->id_parent = $this->request->getPost('id_parent');

        $messages = $object->validation();
        if (count($messages)) {
            $this->view->setVar('message', parent::displayMessage($messages));
            return true;
        }

        if($id)
            $object->update();
        else {
            $object->position = Modules::maximum(["column"  => "position", "conditions" => "id_parent = :id:", "bind" => ["id" => $object->id_parent]]) + 1;
            $object->save();
        }

        $id_parent = '';
        if($object->id_parent)
            $id_parent = $object->id_parent;

        $this->redirect($object->id_modules, $id_parent);
    }

    public function positionAction() {
        $module = new Modules();
        parent::position($module);
    }

    protected function setParents() {
        $modules = Modules::find();
        $this->view->setVar('modules', $modules);
    }
}

