<?php

namespace Modules\Models;

class Tools extends \Phalcon\Mvc\Model
{
    /**
     * Обрезка длинного описания
     * @param $str
     * @param int $length
     * @param string $suffix
     * @return string
     */
    public static function truncate($str, $length = 35, $suffix = '...') {
        mb_internal_encoding("UTF-8");
        return mb_substr($str, 0, $length).$suffix;
    }

    /**
     * Дата с русскими месяцами
     * @param $date
     * @return string
     */
    public static function getDate($date) {
        $months = array(
            "Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря"
        );
        $time = strtotime($date);
        return date('j', $time) . ' ' . $months[date('n', $time) - 1] . ' ' . date('Y', $time);
    }

    /**
     * Склонение по кол-ву комментариев
     * @param $number
     * @return string
     */
    public static function pluralFormComments($number) {
        $cases = array (2, 0, 1, 1, 1, 2);
        $after = array('комментарий','комментария','комментариев');
        return $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
    }

    /**
     * Создание деревьев
     * @param array $items
     * @param int $parent_id
     * @param bool $only_parent
     * @param string $primary
     * @param bool $first
     * @return array|null
     */
    public static function makeTree($items, $parent_id, $only_parent = false, $primary, $first = false) {
        if($first) {
            $result = array();
            foreach ($items as &$item) {
                $result[$item['id_parent']][$item[$primary]] = $item;
            }
            return Tools::makeTree($result, $parent_id, $only_parent, $primary);
        }
        if(is_array($items) and isset($items[$parent_id])){
            $tree = array();
            if($only_parent==false){
                foreach($items[$parent_id] as $item){
                    $item['children'] = Tools::makeTree($items,$item[$primary], false, $primary);
                    $tree[] = $item;
                }
            }elseif(is_numeric($only_parent)) {
                $item = $items[$parent_id][$only_parent];
                $item['children'] = Tools::makeTree($items, $item[$primary], false, $primary);
                $tree[] = $item;
            }
        }
        else return null;
        return $tree;
    }

    /**
     * Рекурсивыный вывод категорий
     * @param $categories
     * @param $selected
     * @param bool $first
     * @return string
     */
    public static function makeMenu($categories, $selected, $first = true) {
        if(!is_array($selected)) {
            $selected = array($selected);
        }

        if($first) {
            $selected = Category::getAllParents($selected[0]);
        }
        if(!count($categories))
            return false;
        $html = '';
        $links = new Link();
        foreach ($categories as $category) {
            $classes = array();
            if(in_array($category['id_category'], $selected))
                $classes[] = 'menu__item_active';
            if(isset($category['children']) && count($category['children']) > 0)
                $classes[] = 'menu__item_has-child';
            $html .= '<li class="' . (implode(" ", $classes)) . ' CLOSE menu__item">';
            $id_category = $category['id_category'];
            $rel = '';
            if(isset($category['children']) && count($category['children']) > 0 && !$category['id_parent']) {
                $id_category = $category['children'][0]['id_category'];
                $rel = ' rel="nofolow"';
            }
            $html .= '<span class="menu__link-wrap"><a href="' . $links->getCategoryLink($id_category) . '"' . $rel . ' class="menu__link">';
            $html .= $category['name'];
            $html .='</a>';
            if(isset($category['children']) && count($category['children']) > 0)
                $html .= '<span class="menu__grower CLOSE"></span>';
            $html .='</span>';
            if(isset($category['children']) && count($category['children']) > 0) {
                $html .= '<ul class="menu__child">';
                $html .= Tools::makeMenu($category['children'], $selected, false);
                $html .= '</ul>';
            }
            $html .= '</li>';
        }
        return $html;
    }

    public static function selectList($items, $depth, $ids, $primary) {
        $html = '';
        if(!is_array($ids))
            $ids = array($ids);
        foreach ($items as $item) {
            $html .= '<option value="' . $item[$primary] . '"' . (in_array($item[$primary], $ids) ? ' selected="selected"' : '') . '>' . str_repeat("&nbsp;", $depth*5) . $item['name'] . '</option>';
            if(isset($item['children']) && $item['children']) {
                $html .= Tools::selectList($item['children'], $depth+1, $ids, $primary);
            }
        }
        return $html;
    }

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

    /**
     * Ip адресс клиента
     * @return string
     */
    public static function getClientIp() {

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return (string)$ip;
    }

    /**
     * Delete unicode class from regular expression patterns
     * @param string $pattern
     * @return string pattern
     */
    public static function cleanNonUnicodeSupport($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) {
            return $pattern;
        }
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
}