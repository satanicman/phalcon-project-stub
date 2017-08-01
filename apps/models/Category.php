<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Modules\Models\LinkRewriteValidator as LinkRewrite;
use Phalcon\Validation\Validator;
use Modules\Models\Page as Page;
use Modules\Models\Rubric as Rubric;

class Category extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_category;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_parent;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_template = 0;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $description;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $link_rewrite;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $meta_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $meta_keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $meta_description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active = 1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $shown = 1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $position;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $create_date;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $edit_date;

    public static function getAllParents($id_category)
    {
        $result[] = $id_category;
        $category = Category::findFirst([
            "conditions" => "id_category = :id:",
            "bind" => [
                "id" => $id_category
            ],
            "columns" => ["id_parent"]
        ]);

        if($category)
            $result = array_merge($result, self::getAllParents($category->id_parent));

        return $result;
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'name',
            new PresenceOf(
                [
                    'message' => '<strong>Ошибка!</strong> Поле "Название" обязательно к заполнению',
                ]
            )
        );

        $validator->add(
            'link_rewrite',
            new PresenceOf(
                [
                    'message' => '<strong>Ошибка!</strong> Поле "ЧПУ" обязательно к заполнению',
                ]
            )
        );

        $validator->add(
            'link_rewrite',
            new LinkRewrite(
                [
                    'message' => '<strong>Ошибка!</strong> Неправильный формат "ЧПУ"',
                ]
            )
        );

        return $validator->validate($this);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Category[]|Category
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Category
     */
    public static function findFirst($parameters = null)
    {
        $category = parent::findFirst($parameters);
        if($category && isset($category->id_template)) {
            $tpl = Templates::findFirst([
                "conditions" => "id_template = :id:",
                "bind" => [
                    "id" => $category->id_template
                ],
                "columns" => "link"
            ]);
            $category->tpl = $tpl ? $tpl->link : "default";
        }
        return $category;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'category';
    }

    public function getAllPages($order_by, $total = false) {
        if($total) {
            $result = Page::find([
                "conditions" => "id_category = :id: AND id_rubric = 0",
                "bind" => [
                    "id" => $this->id_category
                ]
            ])->toArray();

            return count($result);
        }

        $pages =  Page::find([
            "conditions" => "id_category = :id: and active = 1",
            "bind" => [
                "id" => $this->id_category
            ],
            "order" => $order_by
        ])->toArray();


        foreach ($pages as &$page) {
            $page['totalComments'] = (int)Comments::getCommentsByPageId($page['id_page'], true);
        }

        return $pages;
    }
    public function getPages($p, $n, $order_by, $total = false, $id_rubric = false) {
        $conditions = "id_category = :id: and active = 1" . ($id_rubric ? " and id_rubric = {$id_rubric}" : '');

        if($total) {
            if($id_rubric == 7)
                return Page::getCobble($p, $n, $this->id_category, true);

            $result = Page::find([
                "conditions" => $conditions,
                "bind" => [
                    "id" => $this->id_category
                ]
            ])->toArray();

            return count($result);
        }

        if($id_rubric && $id_rubric == 7) {
            $pages = Page::getCobble($p, $n, $this->id_category);
        }
        else {
            $pages = Page::find([
                "conditions" => $conditions,
                "bind" => [
                    "id" => $this->id_category
                ],
                "order" => $order_by,
                'offset' => ($p - 1) * $n,
                'limit' => $n
            ])->toArray();
        }


        foreach ($pages as &$page) {
            $page['totalComments'] = (int)Comments::getCommentsByPageId($page['id_page'], true);
        }

        return $pages;
    }

    public function getRubrics($p = 1, $n)
    {
        $rubrics = Rubric::find([
            "conditions" => "id_category = :id:",
            "bind" => [
                "id" => $this->id_category
            ],
            "order" => "position"
        ])->toArray();

        foreach ($rubrics as &$rubric) {
            if($rubric['id_rubric'] == 7)
                $rubric["pages"] = Page::getCobble($p, $n, $this->id_category);
            else
                $rubric["pages"] = Page::getPagesByRubricId($rubric['id_rubric'], $this->id_category, $p, $n);
        }

        return $rubrics;
    }

//    public static function getSubcategories($id_category, $first = false) {
//        if(!is_int($id_category))
//            return false;
//
//        if($first) {
//            $category = array();
//        } else {
//            $category = Category::findFirst($id_category)->toArray();
//            if (!$category)
//                return false;
//        }
//
//        $children = Category::find([
//            "conditions" => "id_parent = :id:",
//            "bind" => [
//                "id" => $id_category
//            ]
//        ])->toArray();
//
//        if($children) {
//            foreach ($children as $child) {
//                if($first) {
//                    $category[$child["id_category"]] = Category::getSubcategories((int)$child["id_category"]);
//                } else {
//                    $category["children"][$child["id_category"]] = Category::getSubcategories((int)$child["id_category"]);
//                }
//            }
//        }
//
//        return $category;
//    }

    /**
     * @param $id_category
     * @return int Получение идентификатора категории самого верхнего уровня
     * @internal param $id
     * Получение идентификатора категории самого верхнего уровня
     */
    public function getRootCategory($id_category) {
        $category = Category::findFirst(["conditions" => "id_category = :id:", "bind" => ["id" => $id_category]]);
        $root_id = (int)$category->id_category;
        if($category->id_parent) {
            $root_id = $this->getRootCategory($category->id_parent);
        }

        return $root_id;
    }
}
