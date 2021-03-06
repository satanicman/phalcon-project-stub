<?php

namespace Modules\Controllers;

use Modules\Models\Context;
use Modules\Models\Employee;
use Modules\Models\Tools,
    Modules\Models\Db;

class AdminController extends Controller
{
    /** @var array Массив щшибок */
    public $errors = array();

    /** @var string Сортироваит по */
    public $orderBy;

    /** @var string Сортироваль по ('ASC', 'DESC') */
    public $orderWay;

    /** @var int Номер текущей страницы */
    public $p;

    /** @var int Кол-во элементнов на странице */
    public $n;

    public function checkAccess()
    {
//        return Employee::isActive($this->session->get('auth')['id_employee']);
        return true;
    }

    public function afterExecuteRoute($dispatcher)
    {
        parent::afterExecuteRoute($dispatcher);
    }

    public function init()
    {
        parent::init();

        $this->context->employee = new Employee($this->context->cookies->get('id_employee')->getValue());

        if (isset($_GET['logout'])) {
            $this->context->employee->logout();
        }

        if ($this->context->cookies->has('last_activity')) {
            if ($this->context->cookies->get('last_activity')->getValue() + 900 < time()) {
                $this->context->employee->logout();
            } else {
                $this->context->cookies->set('last_activity', time());
                $this->context->cookies->send();
            }
        }

        if ($this->router->getControllerName() != 'login' && (!isset($this->context->employee) || !$this->context->employee->isLoggedBack())) {
            if (isset($this->context->employee)) {
                $this->context->employee->logout();
            }

            $url = $this->context->link->getAdminLink('', '');
            $this->response->redirect($url);
        }
    }

    public function postProcess()
    {
    }

    protected function redirect()
    {
        return $this->response->redirect($this->redirect_after);
    }

    public function display()
    {
        $class_name = '';
        if(!empty($this->php_self))
            $class_name = $this->php_self;

        $this->view->setVars(array(
            'baseUrl'           => _BASE_URL_.'admin',
            'theme_img_dir'     => _BACK_IMG_DIR_,
            'theme_css_dir'     => _BACK_CSS_DIR_,
            'theme_js_dir'      => _BACK_JS_DIR_,
            'user'              => new Employee($this->cookies->get('id_employee')),
            'flash'             => $this->flash,
            'class_name'        => $class_name,
            'css_files'         => $this->css_files,
            'js_files'          => $this->js_files,
            'js_def'            => $this->js_defs,
            'tabs' => array()
        ));
    }

    public function setMedia()
    {
        $this->addCSS(_BASE_URL_ . 'libs/bootstrap/css/bootstrap.min.css');
        $this->addCSS(_BASE_URL_ . 'libs/bootstrap/css/bootstrap.utilities.min.css');
        $this->addCSS(_BASE_URL_ . 'libs/bootstrap/css/bootstrap-toggle.min.css');
        $this->addCSS(_BASE_URL_ . 'libs/font-awesome/css/font-awesome.min.css');
        $this->addCSS(_BASE_URL_ . 'libs/AdminLTE/css/AdminLTE.min.css');
        $this->addCSS(_BASE_URL_ . 'libs/AdminLTE/css/skins/skin-blue.css');
        $this->addCSS(_BASE_URL_ . 'libs/iCheck/square/blue.css');
        $this->addCSS(_BACK_CSS_DIR_ . 'global.css');

        $this->addJS(_BASE_URL_ . 'libs/jQuery/jQuery-2.1.3.min.js');
        $this->addJS(_BASE_URL_ . 'libs/bootstrap/js/bootstrap.min.js');
        $this->addJS(_BASE_URL_ . 'libs/iCheck/icheck.min.js');
        $this->addJS(_BASE_URL_ . 'libs/ckeditor/ckeditor.js');
        $this->addJS(_BACK_JS_DIR_ . 'global.js');
        $this->addJS(_BACK_JS_DIR_ . 'app.min.js');
        $this->addJS(_BACK_JS_DIR_ . 'jquery.friendurl.min.js');
        $this->addJS('https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js');

        $this->addJsDef(array(
            'test' => 'test',
            'test1' => 1
        ));

        return true;
    }


    protected function changeStatus($active, $object) {

        $ids = $this->request->getPost('id');

        if(!is_array($ids))
            $ids = array($ids);

        foreach ($ids as $id) {
            $item = $object->findFirst($id);
            $item->active = $active;
            $item->update();
        }
    }

    protected function displayMessage($error, $type = 'danger')
    {
        $output = '<div class="alert alert-'.$type.'" role="alert">';
        if(is_array($error)) {
            $output .= '<ul>';
            foreach ($error as $msg) {
                $output .= '<li>'.$msg.'</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= $error;
        }
        $output .= '</div>';

        return $output;
    }

    protected function pagination($total_items)
    {
        if($p = $this->request->getQuery('p'))
            $this->p = $p;

        if (!is_numeric($this->p) || $this->p < 1) {
            Tools::redirect($this->context->link->getPaginationLink(false, false, $this->n, false, 1, false));
        }

        $range = 2; /* how many pages around page selected */
        $start = (int)($this->p - $range);
        if ($start < 1) {
            $start = 1;
        }

        $pages_nb = ceil($total_items/$this->n);
        $stop = (int)($this->p + $range);
        if ($stop > $pages_nb) {
            $stop = (int)$pages_nb;
        }

        $params = '';
        foreach ($_GET as $name => $query) {
            if($name != '_url' and $name != 'p'){
                if(!$params)
                    $params .= '?';
                else {
                    $params .= '&';
                }

                $params .= $name.'='.$query;
            }


        }
        $requestPage = $this->request->getQuery('_url').$params;

        $this->view->setVars([
            'requestPage' => $requestPage,
            'p' => $this->p,
            'pages_nb' => $pages_nb,
            'start' => $start,
            'stop' => $stop,
            'range' => $range
        ]);
    }
}