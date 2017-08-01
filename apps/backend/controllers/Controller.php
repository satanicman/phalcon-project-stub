<?php

namespace Modules\Backend\Controllers;


abstract class Controller extends \Phalcon\Mvc\Controller
{
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

    /** @var string Название страницы */
    public $page_name;

    /**
     * Проверка доступа пользователя к данному контроллеру
     */
    abstract public function checkAccess();

    /**
     * Устанавливаем CSS и JS файлы контроллеров
     *
     * @return bool
     */
    abstract public function setMedia();

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
}