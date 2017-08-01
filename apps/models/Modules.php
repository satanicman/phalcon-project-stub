<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Modules\Models\LinkRewriteValidator as LinkRewrite;
use Phalcon\Validation\Validator;

class Modules extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_modules;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $name;

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
    public $action = 'index';

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active = 1;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $icon;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id_parent = 0;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $position = 0;

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
        return 'modules';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Modules[]|Modules
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Modules
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
