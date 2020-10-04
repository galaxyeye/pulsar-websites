<?php

/**
 * Path to the application's models directory.
 */
define('VENDOR', ROOT_DIR.'vendor'.DS);

/**
 * Path to the application's models directory.
 */
define('MODELS', APP_SRC.'models'.DS);

/**
 * Path to model behaviors directory.
 */
define('BEHAVIORS', MODELS.'behaviors'.DS);

/**
 * Path to the application's controllers directory.
 */
define('CONTROLLERS', APP_SRC.'controllers'.DS);

/**
 * Path to the application's components directory.
 */
define('COMPONENTS', CONTROLLERS.'components'.DS);

/**
 * Path to the application's src directory.
 */
define('APPLIBS', APP_SRC.'libs'.DS);

/**
 * Path to the application's views directory.
 */
define('VIEWS', APP_SRC.'views'.DS);

/**
 * Path to the application's helpers directory.
 */
define('HELPERS', VIEWS.'helpers'.DS);

/**
 * Path to the application's view's layouts directory.
 */
define('LAYOUTS', VIEWS.'layouts'.DS);

/**
 * Path to the application's view's elements directory.
 * It's supposed to hold pieces of PHP/HTML that are used on multiple pages
 * and are not linked to a particular layout (like polls, footers and so on).
 */
define('ELEMENTS', VIEWS.'elements'.DS);

/**
 * Path to the src directory.
 */
define('LIBS', CORE_PATH . 'src' . DS);

/**
 * Path to the public CSS directory.
 */
define('CSS', WWW_ROOT.'css'.DS);

/**
 * Path to the public JavaScript directory.
 */
define('JS', WWW_ROOT.'js'.DS);

/**
 * Path to the public images directory.
 */
define('IMAGES', WWW_ROOT.'img'.DS);

/**
 * Path to the console src direcotry.
 */
define('CONSOLE_LIBS', CORE_PATH.'console'.DS.'libs'.DS);

/**
 * Web path to the public images directory.
 */
if (!defined('IMAGES_URL')) {
    define('IMAGES_URL', 'img/');
}

/**
 * Web path to the CSS files directory.
 */
if (!defined('CSS_URL')) {
    define('CSS_URL', 'css/');
}

/**
 * Web path to the js files directory.
 */
if (!defined('JS_URL')) {
    define('JS_URL', 'js/');
}
