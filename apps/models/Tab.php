<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator;

class Tab extends ObjectModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_tab;

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
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $class_name;

    /**
     *
     * @var string
     * @Column(type="string", length=64, nullable=false)
     */
    public $name;

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
            'class_name',
            new PresenceOf(
                [
                    'message' => '<strong>Ошибка!</strong> Поле "Название класса" обязательно к заполнению',
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
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'tab';
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

