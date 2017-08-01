<?php

namespace Modules\Models;

abstract class ObjectModel extends \Phalcon\Mvc\Model
{

    public function onConstruct($id)
    {
        $classname = get_class($this);

        if($id) {
            $result = $classname::findFirst($id);
            if($result) {
                foreach ($result as $colName => $colValue) {
                    $this->{$colName} = $colValue;
                }
            }
        }
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return object
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return object
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function update($data = null, $whiteList = null)
    {
        return parent::update($data, $whiteList);
    }

    public function save($data = null, $whiteList = null)
    {
        return parent::save($data, $whiteList);
    }

    abstract public function validation();
}