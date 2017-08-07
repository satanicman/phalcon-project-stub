<?php

namespace Modules\Models;

class Context
{
    /* @var Context */
    protected static $instance;

    public $cookies;

    public $session;

    /** @var Link */
    public $link;

    /** @var Employee */
    public $employee;

    public $tab;

    public $controller;

    public $cache;

    /**
     * Get a singleton instance of Context object
     *
     * @return Context
     */
    public static function getContext()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Context();
        }

        return self::$instance;
    }
}
