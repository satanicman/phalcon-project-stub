<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Category as Category;
use Modules\Models\Page;
use Modules\Models\Links;
use Modules\Models\Tools;
use Modules\Models\Configuration;

class ControllerBase extends \Phalcon\Mvc\Controller
{
    protected $url;
    protected $countComments = 5;
    protected $commentsModeration = "1";
    protected $n = 100;
    protected $p = 1;
    protected $errors = array();

    public function initialize() {
        $this->countComments = Configuration::get('comment_count');
        $this->commentsModeration = Configuration::get('comment_moderation') ? '1' : '0, 1';
        $this->n = Configuration::get('page_count');

        $parameters = array(
            "id_category" => $this->dispatcher->getParam("id_category"),
            "id_page" => $this->dispatcher->getParam("id_page"),
        );
        $this->setGlobalVars();
        $categories = Category::find([
            "conditions" => "active = 1",
            "order" => "position"
        ])->toArray();
        $this->view->setVar('horizontal_menu_items', Tools::makeTree($categories, 0, false, 'id_category', true));
        $selected = 0;
        if($parameters['id_category'])
            $selected = $parameters['id_category'];
        elseif($parameters['id_page'])
            $selected = Page::getCategory($parameters['id_page']);
        
        $this->view->setVar('selected', $selected);

        $this->initConfiguration();
        $this->setBanners();
    }

    public function setGlobalVars() {
        $this->view->setVars(array(
            'baseUrl' => _URL_,
            'link' => new Links,
            'url' => $this->url.'/'
        ));
    }

    protected function setBanners() {
        $id_category = 0;
        if($this->dispatcher->getParam("id_category"))
            $id_category = $this->dispatcher->getParam("id_category");
        elseif ($this->dispatcher->getParam("id_page")) {
            $page = Page::findFirst([
                'conditions' => 'id_page = :id: AND active = 1',
                'bind' => [
                    'id' => $this->dispatcher->getParam("id_page")
                ]
            ])->toArray();

            if($page)
                $id_category = $page['id_category'];
        }
        $banners = $this->modelsManager->createBuilder()
            ->columns('b.id_banner, b.link, b.description, b.name, b.position')
            ->addFrom('\Modules\Models\Banners', 'b')
            ->leftJoin('\Modules\Models\CategoryBanners', 'cb.id_banner = b.id_banner', 'cb')
            ->where('cb.id_category = "'.(int)$id_category.'"')
            ->orWhere('cb.id_category = 0')
            ->andWhere('b.active = 1')
            ->andWhere('b.google = 1')
            ->orderBy('b.id_banner DESC')
            ->getQuery()
            ->execute()
            ->toArray();

        $result = array();
        foreach ($banners as $banner) {
            $result[$banner['position']] = $banner;
        }

        $this->view->setVar('banners', $result);
    }

    private function initConfiguration()
    {
        $configuration = Configuration::find()->toArray();

        foreach ($configuration as $key => $item) {
            $configuration[$item['name']] = $item['value'];
            unset($configuration[$key]);
        }

        $this->view->setVar("configuration", $configuration);
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