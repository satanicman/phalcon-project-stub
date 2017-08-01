<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Azs;
use Modules\Models\Category;
use Modules\Models\Region;
use Modules\Models\Rubric;
use Modules\Models\Page;
use Modules\Models\Tools;
use Modules\Models\Comments;
use Modules\Models\Templates;

class CategoryController extends ControllerBase
{

    public function showAction()
    {
        // Записываем парраматры из ЧРУ
        $parameters = array(
            "id_category" => $this->dispatcher->getParam("id_category"),
            "rewrite" => $this->dispatcher->getParam("rewrite")
        );

        $category = Category::findFirst([
            "conditions" => "id_category = :id_category: and active = 1",
            "bind" => [
                "id_category" => $parameters["id_category"]
            ]
        ]);

        if (!$category) {
            $this->response->redirect(["for" => "404"]);
            return false;
        }

        $order_by = $category->id_category == 37 ? "position" : "edit_date DESC, create_date DESC";
        $styles = array();
        $scripts = array();

        $subcategories = Category::find([
            "conditions" => "active = 1 and shown = 1",
            "order" => "position"
        ])->toArray();

        if($category->tpl == 'stamps' || $category->id_category == 44)
            $order_by = 'name';

        if($rubrics = $category->getRubrics($this->p, $this->n)) {
            $this->view->setVar('rubrics', $rubrics);
        } else {
            if($category->tpl == 'stamps') {
                $this->view->setVar('pages', $category->getAllPages($order_by));
            } elseif($category->tpl == 'calculator') {
                $styles[]['path'] = 'css/calculator.css';
                $scripts[]['path'] = 'js/calculator.js';
            } elseif($category->tpl == 'price-uk') {
                $styles[]['path'] = 'css/fuel-price-country.css';
                $scripts[]['path'] = 'js/fuel-price-country.js';
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
                    'date' => $date,
                    'dates' => Azs::getAllDates(),
                    'id_region' => $id_region,
                    'fuels' => Azs::getAzsesByDateAndRegionId($id_region, $date),
                    'regions' => Region::find()->toArray()
                ]);
            } else {
                parent::pagination($category->getPages(false, false, false, true));
                $this->view->setVar('pages', $category->getPages($this->p, $this->n, $order_by));
            }
        }

        $this->view->setVars([
            'styles' => $styles,
            'scripts' => $scripts,
            'category' => $category,
            'subcategories' => Tools::makeTree($subcategories, $category->getRootCategory($category->id_category),false,'id_category', true)
        ]);
    }
}

