<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator;

class Tab extends \Phalcon\Mvc\Model
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

    /**
     * return an available position in subtab for parent $id_parent
     *
     * @param mixed $id_parent
     * @return int
     */
    public static function getNewLastPosition($id_parent)
    {
        $sql = '
			SELECT IFNULL(MAX(position),0)+1
			FROM `tab`
			WHERE `id_parent` = '.(int)$id_parent;

        return $sql;
    }

    public function cleanPositions($id_parent)
    {
//        $result = '
//			SELECT `id_tab`
//			FROM `tab`
//			WHERE `id_parent` = '.(int)$id_parent.'
//			ORDER BY `position`
//		';

//        $sizeof = count($result);
//        for ($i = 0; $i < $sizeof; ++$i) {
//            $sql = '
//				UPDATE `tab`
//				SET `position` = '.($i + 1).'
//				WHERE `id_tab` = '.(int)$result[$i]['id_tab']
//            ;
//        }

        return true;
    }

    public function updatePosition($way, $position)
    {
//        if (!$res = '
//			SELECT t.`id_tab`, t.`position`, t.`id_parent`
//			FROM `tab` t
//			WHERE t.`id_parent` = '.(int)$this->id_parent.'
//			ORDER BY t.`position` ASC'
//        ) {
//            return false;
//        }
//
//        foreach ($res as $tab) {
//            if ((int)$tab['id_tab'] == (int)$this->id) {
//                $moved_tab = $tab;
//            }
//        }
//
//        if (!isset($moved_tab) || !isset($position)) {
//            return false;
//        }
//        $result = '
//			UPDATE `tab`
//			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
//			WHERE `position`
//			'.($way
//                    ? '> '.(int)$moved_tab['position'].' AND `position` <= '.(int)$position
//                    : '< '.(int)$moved_tab['position'].' AND `position` >= '.(int)$position).'
//			AND `id_parent`='.(int)$moved_tab['id_parent'])
//            && '
//			UPDATE `tab`
//			SET `position` = '.(int)$position.'
//			WHERE `id_parent` = '.(int)$moved_tab['id_parent'].'
//			AND `id_tab`='.(int)$moved_tab['id_tab'];
//
//        return $result;
    }

}

