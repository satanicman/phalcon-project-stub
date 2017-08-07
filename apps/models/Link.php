<?php

namespace Modules\Models;

class Link extends \Phalcon\Mvc\Model
{
    protected $page_url = 'page';
    protected $category_url = 'category';

    /**
     * Return a link to page
     * @param $page
     * @return bool|string
     */
    public function getPageLink($page) {
        if (!is_object($page)) {
            if (is_array($page) && isset($page['id_page'])) {
                $page = Page::findFirst($page['id_page']);
            } elseif ((int)$page) {
                $page = Page::findFirst((int)$page);
            } else {
                return false;
            }
        }

        $category = false;
        if($page->id_category)
            $category = Category::findFirst($page->id_category);

        $category_rewrite = 'root';
        if($category)
            $category_rewrite = $category->link_rewrite;

        $base = _URL_;

        return $base.$this->page_url.'/'.$category_rewrite.'/'.$page->id_page.'-'.$page->link_rewrite;
    }


    /**
     * Return a link to category page
     * @param $category
     * @return bool|string
     */
    public function getCategoryLink($category) {

        if (!is_object($category)) {
            if (is_array($category) && isset($category['id_page'])) {
                $category = Category::findFirst($category['id_page']);
            } elseif ((int)$category) {
                $category = Category::findFirst((int)$category);
            } else {
                return false;
            }
        }

        $base = _URL_;

        return $base.$this->category_url.'/'.$category->id_category.'-'.$category->link_rewrite;
    }

    public static function getPageImage($page, $type = 'default') {
        if (!is_object($page)) {
            if (is_array($page) && isset($page['id_page'])) {
                $page = Page::findFirst($page['id_page']);
            } elseif ((int)$page) {
                $page = Page::findFirst((int)$page);
            } else {
                return false;
            }
        }

        if(file_exists(_PATH_.'/'._PAGE_IMG_.$page->id_page.'-'.$type.'.jpg')){
            return _URL_.'public/'._PAGE_IMG_.$page->id_page.'-'.$type.'.jpg';
        } elseif(file_exists(_PATH_.'/'._PAGE_IMG_.$page->id_page.'.jpg')) {
            return _URL_.'public/'._PAGE_IMG_.$page->id_page.'.jpg';
        } else {
            return _URL_._IMG_.'image-not-found.gif';
        }
    }

    public static function goPage($page, $p) {
        if($p)
            return $page.(preg_match('/\?/', $page) ? '&' : '?').'p='.$p;
        else
            return $page;
    }


    public function getAdminLink($controller, $action = 'index', $params = array())
    {
        $query = http_build_query($params, '', '&');

        $url = strtolower(preg_replace('/Controller$/', '', $controller));

        return '/' . _ADMIN_URL_ . ($url ? '/' . $url : '') . ($action ? '/' . $action : '') . ($query ? '?' : '') . $query;
    }
}