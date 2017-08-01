<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Modules\Models\LinkRewriteValidator as LinkRewrite;
use Phalcon\Validation\Validator;
use Modules\Models\Comments;
use \Phalcon\Mvc\Model\Query\Builder;

class Page extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_page;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id_category;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id_rubric;

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
     * @Column(type="string", length=128, nullable=true)
     */
    public $meta_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    public $meta_keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
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
     * @Column(type="integer", length=11, nullable=false)
     */
    public $position = 0;

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
    protected $totalComments;

    public function onConstruct() {
        $this->totalComments = Comments::getCommentsByPageId($this->id_page, true);
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
     * Initialize method for model.
     */
    public function initialize()
    {
//        $this->setSchema("auto-portal");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'page';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Page[]|Page
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Page
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public static function getPagesByRubricId($id_rubric, $id_category,  $p, $n)
    {
        $pages = Page::find([
            "conditions" => "id_rubric = :id_rubric: and id_category = :id_category: and active = 1",
            "bind" => [
                "id_rubric" => $id_rubric,
                "id_category" => $id_category
            ],
            "order" => "edit_date DESC, create_date DESC",
            'offset' => ($p - 1) * $n,
            'limit' => $n
        ])->toArray();

        if(!$pages)
            return false;

        foreach ($pages as &$page) {
            $page['totalComments'] = Comments::getCommentsByPageId($page['id_page'], true);
        }

        return $pages;
    }

    public static function getCategory($id_page)
    {
        $page = self::findFirst($id_page);
        if($page)
            return $page->id_category;

        return false;
    }

    public static function getCobble($p, $n, $id_category, $total = false)
    {
        $builder = new Builder();
        $sql = $builder->columns('p.*')
            ->addFrom('\Modules\Models\Comments', 'c')
            ->innerJoin('\Modules\Models\Page', 'p.id_page = c.id_page AND p.id_category = \'' .(int)$id_category . '\' AND p.active = 1 AND c.active = 1', 'p')
            ->groupBy('c.id_page')
            ->orderBy('COUNT(c.id_page) DESC');

        if($total) {
            return count($sql->getQuery()->execute()->toArray());
        } else {
            $sql = $sql
                ->limit($n)
                ->offset(($p - 1) * $n)
                ->getQuery();
        }

        $result = $sql->execute()->toArray();

        return $result;
    }
}
