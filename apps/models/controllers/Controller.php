<?php

namespace Modules\Controllers;

use Modules\Models\Context;
use Modules\Models\Validate;

abstract class Controller extends \Phalcon\Mvc\Controller
{
    /** @var Context */
    protected $context;

    /** @var array Массив CSS фа */
    public $css_files = array();

    /** @var array Массив JS файлов */
    public $js_files = array();

    /** @var array Массив JS файлов */
    public $js_defs = array();

    /** @var bool Если ajax запрос, задать значение true */
    public $ajax = false;

    /** @var string Название контроллера */
    public $php_self;

    /** @var array Ошибки */
    public $errors = array();

    /** @var array List of PHP errors */
    public static $php_errors = array();

    protected $redirect_after = null;

    /**
     * Устанавливаем CSS и JS файлы контроллеров
     *
     * @return bool
     */
    abstract public function setMedia();

    /**
     * Обработка данных из запросов: process input, process AJAX, etc.
     */
    abstract public function postProcess();

    /**
     * Redirects to $this->redirect_after after the process if there is no error
     */
    abstract protected function redirect();

    /**
     * Displays page view
     */
    abstract public function display();

    /**
     * Initialize the page
     */
    public function init()
    {
        if (_MODE_DEV_) {
            set_error_handler(array(__CLASS__, 'myErrorHandler'));
        }
    }

    /**
     * Старт обработки контролеров
     */
    public function initialize()
    {
        $di = \Phalcon\DI::getDefault();

        $this->context = Context::getContext();
        $this->context->controller = $this;
        $this->context->cookies = $di['cookies'];
        $this->context->session = $di['session'];
        $this->context->link = $di['link'];

        $this->init();
        // Подключение всех необходимых библиотек
        $this->setMedia();

        // postProcess handles ajaxProcess
        $this->postProcess();

        $this->display();
    }

    public function afterExecuteRoute($dispatcher)
    {
        if (!empty($this->redirect_after)) {
            $this->redirect();
        }
    }

    /**
     * Добавляет новые файлы стилей в шапку сайта
     *
     * @param string|array $css_uri Путь к CSS файлу или массив CSS файлов. Пример : array(array(uri => media_type),
     * ...)
     * @param string $css_media_type
     * @param int|null $offset
     * @return true
     */
    public function addCSS($css_uri, $css_media_type = 'all', $offset = null)
    {
        if (!is_array($css_uri)) {
            $css_uri = array($css_uri);
        }

        foreach ($css_uri as $css_file => $media) {
            if (is_string($css_file) && strlen($css_file) > 1)
                $css_path = array($css_file => $media);
            else
                $css_path = array($media => $css_media_type);

            $key = is_array($css_path) ? key($css_path) : $css_path;
            if ($css_path && (!isset($this->css_files[$key]) || ($this->css_files[$key] != reset($css_path)))) {
                $size = count($this->css_files);
                if ($offset === null || $offset > $size || $offset < 0 || !is_numeric($offset)) {
                    $offset = $size;
                }

                $this->css_files = array_merge(array_slice($this->css_files, 0, $offset), $css_path, array_slice($this->css_files, $offset));
            }
        }
    }

    /**
     * Добавление новых JavaScript файлов в конец body
     *
     * @param string|array $js_uri Путь к JS файлу или массив. Пример: array(uri, ...)
     * @return void
     */
    public function addJS($js_uri)
    {
        if (is_array($js_uri)) {
            foreach ($js_uri as $js_file) {
                $js_file = explode('?', $js_file);
                $version = '';
                if (isset($js_file[1]) && $js_file[1]) {
                    $version = $js_file[1];
                }
                $js_path = $js_file = $js_file[0];

                // $key = is_array($js_path) ? key($js_path) : $js_path;
                if ($js_path && !in_array($js_path, $this->js_files)) {
                    $this->js_files[] = $js_path.($version ? '?'.$version : '');
                }
            }
        } else {
            $js_uri = explode('?', $js_uri);
            $version = '';
            if (isset($js_uri[1]) && $js_uri[1]) {
                $version = $js_uri[1];
            }
            $js_path = $js_uri = $js_uri[0];

            if ($js_path && !in_array($js_path, $this->js_files)) {
                $this->js_files[] = $js_path.($version ? '?'.$version : '');
            }
        }
    }


    /**
     * Add a new javascript definition at bottom of page
     *
     * @param mixed $js_def
     *
     * @return void
     */
    public function addJsDef($js_def)
    {
        if (is_array($js_def)) {
            foreach ($js_def as $key => $js) {
                $this->js_defs[$key] = $js;
            }
        }
    }


    /**
     * Custom error handler
     *
     * @param string $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @return bool
     */
    public static function myErrorHandler($errno, $errstr, $errfile, $errline)
    {
        if (error_reporting() === 0) {
            return false;
        }

        switch ($errno) {
            case E_USER_ERROR:
            case E_ERROR:
                die('Fatal error: '.$errstr.' in '.$errfile.' on line '.$errline);
                break;
            case E_USER_WARNING:
            case E_WARNING:
                $type = 'Warning';
                break;
            case E_USER_NOTICE:
            case E_NOTICE:
                $type = 'Notice';
                break;
            default:
                $type = 'Unknown error';
                break;
        }

        Controller::$php_errors[] = array(
            'type'    => $type,
            'errline' => (int)$errline,
            'errfile' => str_replace('\\', '\\\\', $errfile), // Hack for Windows paths
            'errno'   => (int)$errno,
            'errstr'  => $errstr
        );

        return true;
    }
}