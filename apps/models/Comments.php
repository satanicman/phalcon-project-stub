<?php

namespace Modules\Models;

class Comments extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_comment;

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
    public $id_page;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    public $active;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_add;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $ip;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Comments[]|Comments
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Comments
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'comments';
    }


    public static function getCommentsByPageId($id_page, $total = false) {
        $moderation = '0, 1';
        if(Configuration::get('comment_moderation'))
            $moderation = '1';

        $comments = Comments::find([
            "conditions" => "id_page = :id: AND active IN ({$moderation})",
            "bind" => [
                "id" => $id_page
            ]
        ])->toArray();

        if(!$comments)
            return false;
        
        if($total)
            return count($comments);

        foreach ($comments as &$comment) {
            $comment['children'] = Comments::find([
                "conditions" => "id_parent = :id_parent: AND active IN ({$moderation})",
                "bind" => [
                    "id_parent" => $comment['id_comment']
                ]
            ])->toArray();
        }

        return $comments;

    }

}
