<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Tools;
use Modules\Models\Search;
use Modules\Models\Comments;

class SearchController extends ControllerBase
{

    public function indexAction()
    {
        $search = $this->request->getQuery('search_query');
        $this->view->setVar('search_query', $search);

        if($search) {
            parent::pagination(Search::search($search, $this->p, $this->n, true));
            $pages = Search::search($search, $this->p, $this->n);
            if($pages) {
                foreach ($pages as &$page) {
                    $page['totalComments'] = (int)Comments::getCommentsByPageId($page['id_page'], true);
                }
                $this->view->setVar('pages', $pages);
            } elseif(!$this->errors) {
                $message = 'Поиск по запросу ' . $search . ' не дал результата';
                $this->flash->warning($message);
                $this->errors[] = $message;
            }
        } else {
            $this->flash->warning('Введите слово для поиска');
        }
    }

}

