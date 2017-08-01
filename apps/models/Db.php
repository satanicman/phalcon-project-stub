<?php

namespace Modules\Models;

use Phalcon\Mvc\Model\Manager as ModelsManager;

class Db extends \Phalcon\Mvc\Model
{
    /**
     * Преобразовываем phalcon query builder в читаемый запрос
     * @param $builder|object
     * @return bool
     */
    public static function getQuery($builder) {

        if(!is_object($builder) || !method_exists($builder, 'parse'))
            return false;

        return \Phalcon\DI::getDefault()['db']->getDialect()->select($builder->parse());
    }

    public static function getInstance()
    {
        $manager = new ModelsManager();
        $manager->setDI(\Phalcon\DI::getDefault());
        return $manager;
    }

    public static function execute($sql) {
        $result_set = \Phalcon\DI::getDefault()['db']->query($sql);
        $result_set->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $result_set = $result_set->fetchAll($result_set);

        return $result_set;
    }
}