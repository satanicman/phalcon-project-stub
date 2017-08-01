<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Page;
use Modules\Models\Comments;
use Modules\Models\Category;
use Modules\Models\Tools;

class PageController extends ControllerBase
{
    protected $url = 'page';

    public function showAction()
    {
        $parameters = array(
            "category" => $this->dispatcher->getParam("category"),
            "id_page" => $this->dispatcher->getParam("id_page"),
            "rewrite" => $this->dispatcher->getParam("rewrite")
        );
        $page = Page::findFirst([
            'conditions' => 'id_page = :id: AND active = 1',
            'bind' => [
                'id' => $parameters['id_page']
            ]
        ])->toArray();

        if (!$page) {
            $this->response->redirect(["for" => "404"]);
            return false;
        }

        $category = Category::findFirst([
            "conditions" => "id_category = :id: and active = 1",
            "bind" => [
                "id" => $page['id_category']
            ]
        ]);

        if (!$category && $page['id_category'] != 90) {
            $this->response->redirect(["for" => "404"]);
            return false;
        }

        $page['totalComments'] = Comments::getCommentsByPageId($page['id_page'], true);

        $subcategories = Category::find([
            "conditions" => "active = 1 and shown = 1",
            "order" => "position"
        ])->toArray();

        $this->view->setVars(array(
            'comments' => Comments::getCommentsByPageId($page['id_page']),
            'countComments' => $this->countComments,
            'totalComments' => $page['totalComments'],
            'page' => $page,
            'subcategories' => Tools::makeTree($subcategories, $category->getRootCategory($category->id_category),false,'id_category', true)
        ));
        return true;
    }

}

