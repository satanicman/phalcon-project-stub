<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Azs;
use Modules\Models\Region;
use Modules\Models\Category;
use Modules\Models\Tools;
use Modules\Models\Statistics;

class AjaxController extends ControllerBase
{

    public function indexAction()
    {
        if($this->request->isGet()) {
            switch ($this->request->getQuery('type')) {
                case 'changeDate':
                    $this->changeDate();
                    break;
                case 'pagination':
                    $this->ajaxPagination();
                    break;
                case 'pageContent':
                    $this->ajaxPageContent();
                    break;
                case 'banner':
                    $this->ajaxBanners();
                    break;
                case 'bannerClick':
                    $this->ajaxBannersClick();
                    break;
            }
        }
    }

    private function changeDate()
    {

        $now = new \DateTime('now');
        $date = $now->format('Y-m-d');
        if($this->request->getQuery('date')){
            $date = new \DateTime($this->request->getQuery('date'));
            $date = $date->format('Y-m-d');
        }

        $region = Region::getRegionByName("Днепр");
        $id_region = (int)$region->id_region;
        if($this->request->getQuery('region')){
            $id_region = (int)$this->request->getQuery('region');
        }

        $this->view->setVars([
            'fuels' => Azs::getAzsesByDateAndRegionId($id_region, $date),
        ]);


        $this->view->start();
        $this->view->render("category", "change");
        $this->view->finish();
        die(json_encode(array('result' => $this->view->getContent())));
    }


    public function ajaxPagination()
    {
        $p = (int)$this->request->getQuery('p');
        $id_category = (int)$this->request->getQuery('id_category');
        $id_rubric = (int)$this->request->getQuery('id_rubric');

        if(!$p || !$id_rubric || !$id_category)
            die(json_encode(array('hasError' => 1, 'errors' => array('Что-то пошло не так'))));

        $c = Category::findFirst($id_category);

        if(!$c->id_category)
            die(json_encode(array('hasError' => 1, 'errors' => array('Категория не найдена'))));

        $pages = $c->getPages($p, $this->n, 'name', true, $id_rubric);

        if(!$pages)
            die(json_encode(array('hasError' => 1, 'errors' => array('Такой страницы не существует'))));

        parent::pagination($pages);

        $this->view->start();
        $this->view->render("partials", "pagination");
        $this->view->finish();
        die(json_encode(array(
            'result' => $this->view->getContent(),
            'pages' => $pages
        )));

    }

    private function ajaxPageContent()
    {
        $p = (int)$this->request->getQuery('p');
        $id_category = (int)$this->request->getQuery('id_category');
        $id_rubric = (int)$this->request->getQuery('id_rubric');

        if(!$p || !$id_rubric || !$id_category)
            die(json_encode(array('hasError' => 1, 'errors' => array('Что-то пошло не так'))));

        $c = Category::findFirst($id_category);

        if(!$c->id_category)
            die(json_encode(array('hasError' => 1, 'errors' => array('Категория не найдена'))));

        $pages = $c->getPages($p, $this->n, 'edit_date DESC, create_date DESC', false, $id_rubric);

        if(!$pages)
            die(json_encode(array('hasError' => 1, 'errors' => array('Такой страницы не существует'))));

        $this->view->setVar('pages', $pages);

        $this->view->start();
        $this->view->render("templates", "news");
        $this->view->finish();
        die(json_encode(array(
            'result' => $this->view->getContent(),
            'pages' => $pages
        )));
    }

    /**
     * Событие показа банера на странице
     * @return bool
     */
    public function ajaxBanners() {
        $id_category = (int)$this->request->getQuery('id_category');
        $id_position = (int)$this->request->getquery('id_position');
        $id_banner = (array)$this->request->getquery('id_banner');
        $is_google = (int)$this->request->getquery('is_google');

        $sql = $this->modelsManager->createBuilder()
            ->columns('b.id_banner, b.link, b.description, b.name, b.google')
            ->addFrom('\Modules\Models\Banners', 'b')
            ->leftJoin('\Modules\Models\CategoryBanners', 'cb.id_banner = b.id_banner', 'cb')
            ->where('cb.id_category = '.$id_category)
            ->orWhere('cb.id_category = 0')
            ->andWhere('b.position = '.$id_position)
            ->andWhere('b.active = 1')
            ->andWhere('b.google = ' . $is_google)
            ->notInWhere('b.id_banner', $id_banner)
            ->getQuery();

        $banners = $sql
            ->execute()
            ->toArray();

        if(!count($banners))
            die(json_encode(array('errors' => 'Кол-во банеров ' . count($banners))));

        $rand = 1;
        if($id_position === 9)
            $rand = count($banners) >= 4 ? 4 : count($banners);
        elseif($id_position === 7 || $id_position === 8)
            $rand = count($banners) >= 2 ? 2 : count($banners);

        $banner_num = array_rand($banners, (int)$rand);
        $result = array();
        if(is_array($banner_num)) {
            foreach ($banner_num as $num) {
                $result[] = $banners[$num];
                Statistics::setByBannerId($banners[$num]['id_banner'], 'show', Tools::getClientIp());
            }
        } else {
            $result[] = $banners[$banner_num];
            Statistics::setByBannerId($banners[$banner_num]['id_banner'], 'show', Tools::getClientIp());
        }


        die(json_encode(array('banners' => $result)));
    }


    /**
     *  Событие клика на банер
     */
    public function ajaxBannersClick() {
        $id_banner = (int)$this->request->getquery('id_banner');
        Statistics::setByBannerId($id_banner, 'click', Tools::getClientIp());
        die(true);
    }
}

