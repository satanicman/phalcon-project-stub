<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Employee;
use Modules\Models\Tab;
use Modules\Controllers\AdminController;

class LoginController extends AdminController
{
    public $php_self = 'login-page';

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($id_employee = Employee::checkAccess($email, $password)) {
                $this->context->employee = new Employee($id_employee);
                $this->context->employee->setLastVisit($this->request->getClientAddress());

                $this->context->cookies->set('id_employee', $this->context->employee->id_employee);
                $this->context->cookies->set('password', $this->context->employee->password);

                if($this->request->getPost('stay_logged_in'))
                    $this->context->cookies->set('last_activity', time());

                $this->context->cookies->send();

                // If there is a valid controller name submitted, redirect to it
                if (isset($_POST['redirect']) && Validate::isControllerName($_POST['redirect'])) {
                    $url = $this->context->link->getAdminLink($_POST['redirect']);
                } else {
                    $tab = new Tab((int)$this->context->employee->default_tab);
                    $url = $this->context->link->getAdminLink($tab->class_name);
                }

                $this->redirect_after = $url;
                return $this->response->redirect($url);
            } else {
                $this->flash->error('<strong>Ошибка</strong> Не верное имя пользователя или пароль.');
            }
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

