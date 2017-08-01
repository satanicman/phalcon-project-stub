<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Employee as Employee;

class IndexController extends ControllerBase
{
    public $page_name = 'login-page';

    public function indexAction()
    {
//        if(isset($this->session->auth) && $this->session->auth['id_employee'])
//            return $this->response->redirect('admin/controlpanel/index');

        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($id_employee = Employee::checkAccess($email, $password)) {
                $employee = Employee::findFirst($id_employee);
                $employee->setLastVisit($this->request->getClientAddress());
                if($this->_registerSession($employee)) {
                    return $this->response->redirect('admin/controlpanel/index');
                }
            }

            $this->flash->error('<strong>Ошибка</strong> Не верное имя пользователя или пароль.');
        }
    }

    public function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect('admin');
    }

    public function route404Action()
    {
        echo "<pre>";
        print_r(404);
        echo "</pre>";
        die();

    }

    public function route503Action()
    {
        echo "<pre>";
        print_r(503);
        echo "</pre>";
        die();

    }

    private function _registerSession($employee)
    {
        $this->session->set('auth', array(
            'id_employee'   => $employee->id_employee,
            'lastname'      => $employee->lastname,
            'firstname'     => $employee->firstname,
            'email'         => $employee->email,
        ));

        return true;
    }
}

