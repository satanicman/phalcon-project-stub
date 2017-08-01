<?php

namespace Modules\Models;

class Configuration extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_configuration;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $value;

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
        return 'configuration';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Configuration[]|Configuration
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Configuration
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    public static function updateValue($key, $value) {
        $configuration = Configuration::findFirst(["conditions" => "name = :name:", "bind" => ["name" => $key]]);
        if(!$configuration)
            $configuration = new Configuration();

        $configuration->name = $key;
        $configuration->value = $value;

        if(!$configuration->id_configuration) {
            $configuration->save();
            return true;
        }

        $configuration->update();
        return true;
    }

    public static function get($key) {
        $configuration = Configuration::findFirst(["conditions" => "name = :name:", "bind" => ["name" => $key], "columns" => "value"])->toArray();
        return $configuration["value"];
    }

}
