<?php
if (!defined('_BASE_URL_')) {
    define('_BASE_URL_', 'http://teplo.loc/');
}

$currentDir = dirname(__FILE__);

/* Debug only */
if (!defined('_MODE_DEV_')) {
    define('_MODE_DEV_', true);
}

/* Directories */
if (!defined('_ROOT_DIR_')) {
    define('_ROOT_DIR_', realpath($currentDir.'/../..'));
}

/* Apps */
if (!defined('_APPS_DIR_')) {
    define('_APPS_DIR_', _ROOT_DIR_.'/apps/');
}

if (!defined('_PHALCON_DIR_')) {
    define('_PHALCON_DIR_', _ROOT_DIR_.'/incubator/Library/Phalcon/');
}

if (!defined('_MODELS_DIR_')) {
    define('_MODELS_DIR_', _APPS_DIR_.'models/');
}

if (!defined('_LIBS_DIR_')) {
    define('_LIBS_DIR_', _APPS_DIR_.'libs/');
}

/* Apps back */
if (!defined('_APPS_BACK_DIR_')) {
    define('_APPS_BACK_DIR_', _APPS_DIR_.'backend/');
}

if (!defined('_APPS_BACK_CONTROLLERS_DIR_')) {
    define('_APPS_BACK_CONTROLLERS_DIR_', _APPS_BACK_DIR_.'controllers/');
}

if (!defined('_APPS_BACK_VIEW_DIR_')) {
    define('_APPS_BACK_VIEW_DIR_', _APPS_BACK_DIR_.'views/');
}

if (!defined('_APPS_BACK_PLUGINS_DIR_')) {
    define('_APPS_BACK_PLUGINS_DIR_', _APPS_BACK_DIR_.'plugins/');
}

if (!defined('_APPS_BACK_CACHE_DIR_')) {
    define('_APPS_BACK_CACHE_DIR_', _APPS_BACK_DIR_.'cache/');
}

/* Apps front */
if (!defined('_APPS_FRONT_DIR_')) {
    define('_APPS_FRONT_DIR_', _APPS_DIR_.'frontend/');
}

if (!defined('_APPS_FRONT_CONTROLLERS_DIR_')) {
    define('_APPS_FRONT_CONTROLLERS_DIR_', _APPS_FRONT_DIR_.'controllers/');
}

if (!defined('_APPS_FRONT_VIEW_DIR_')) {
    define('_APPS_FRONT_VIEW_DIR_', _APPS_FRONT_DIR_.'views/');
}

if (!defined('_APPS_FRONT_PLUGINS_DIR_')) {
    define('_APPS_FRONT_PLUGINS_DIR_', _APPS_FRONT_DIR_.'plugins/');
}

if (!defined('_APPS_FRONT_CACHE_DIR_')) {
    define('_APPS_FRONT_CACHE_DIR_', _APPS_FRONT_DIR_.'cache/');
}

/* Public */
if (!defined('_PUBLIC_DIR_')) {
    define('_PUBLIC_DIR_', _ROOT_DIR_.'/public/');
}

if (!defined('_IMG_DIR_')) {
    define('_IMG_DIR_', _PUBLIC_DIR_.'img/');
}

define('_EDITOR_IMG_DIR_', _IMG_DIR_.'e/');

if (!defined('_JS_DIR_')) {
    define('_JS_DIR_', _PUBLIC_DIR_.'js/');
}

if (!defined('_CSS_DIR_')) {
    define('_CSS_DIR_', _PUBLIC_DIR_.'css/');
}

if (!defined('_THEME_DIR_')) {
    define('_THEME_DIR_', _BASE_URL_.'themes/');
}

/* Front */
if (!defined('_FRONT_THEME_DIR_')) {
    define('_FRONT_THEME_DIR_', _THEME_DIR_.'front/');
}

if (!defined('_FRONT_IMG_DIR_')) {
    define('_FRONT_IMG_DIR_', _FRONT_THEME_DIR_.'img/');
}

if (!defined('_FRONT_CSS_DIR_')) {
    define('_FRONT_CSS_DIR_', _FRONT_THEME_DIR_.'css/');
}

if (!defined('_FRONT_JS_DIR_')) {
    define('_FRONT_JS_DIR_', _FRONT_THEME_DIR_.'js/');
}


/* Back */
if (!defined('_BACK_THEME_DIR_')) {
    define('_BACK_THEME_DIR_', _THEME_DIR_.'back/');
}

if (!defined('_BACK_IMG_DIR_')) {
    define('_BACK_IMG_DIR_', _BACK_THEME_DIR_.'img/');
}

if (!defined('_BACK_CSS_DIR_')) {
    define('_BACK_CSS_DIR_', _BACK_THEME_DIR_.'css/');
}

if (!defined('_BACK_JS_DIR_')) {
    define('_BACK_JS_DIR_', _BACK_THEME_DIR_.'js/');
}