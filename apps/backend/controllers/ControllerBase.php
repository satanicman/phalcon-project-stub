<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Tools,
    Modules\Models\Links,
    Modules\Models\Db;

class ControllerBase extends Controller
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

    public function afterExecuteRoute()
    {
    }

    public function initialize()
	{
        // Подключение всех необходимых библиотек
	    $this->setMedia();

        if(!empty($this->page_name))
            $page_name = $this->page_name;
        else
            $page_name = 'skin-blue';

	    $this->view->setVars(array(
	        'baseUrl' => _BASE_URL_.'admin',
            'flash' => $this->flash,
            'page_name' => $page_name,
            'css_files' => $this->css_files,
            'js_files' => $this->js_files,
            'js_def' => 'var test = 1;console.log(test)'
        ));

        if((!$this->session->has('auth') || !$this->checkAccess()) && $this->router->getControllerName() != 'index') {
            return $this->response->redirect(['for' => 'admin']);
        }

        $this->view->setVars([
            'tabs' => array()
        ]);
	}

	public function setMedia()
    {
        $this->addCSS('/libs/bootstrap/css/bootstrap.min.css');
        $this->addCSS('/libs/font-awesome/css/font-awesome.min.css');
        $this->addCSS('/libs/AdminLTE/css/AdminLTE.min.css');
        $this->addCSS('/libs/AdminLTE/css/skins/skin-blue.css');
        $this->addCSS('/libs/iCheck/square/blue.css');

        $this->addJS('/libs/jQuery/jQuery-2.1.3.min.js');
        $this->addJS('/libs/bootstrap/js/bootstrap.min.js');
        $this->addJS('/libs/iCheck/icheck.min.js');

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