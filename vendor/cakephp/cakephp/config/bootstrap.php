<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

require dirname(__DIR__) . DS . 'basics.php';
require __DIR__ . DS . 'paths.php';

if (!defined("PHP5")) {
    define('PHP5', true);
}

$includes = array(
    CAKE . 'object.php',
    CAKE . 'inflector.php',
    CAKE . 'configure.php',
    CAKE . 'file.php',
    CAKE . 'cache.php',
    CAKE . 'text.php',
    CAKE . 'class_registry.php',
);

foreach ($includes as $inc) {
    if (!require($inc)) {
        pr("Failed to load Cake core file {$inc}");
        $this->stderr("Failed to load Cake core file {$inc}");
        return false;
    }
}

Configure::getInstance();

// Bad API design
App::import('Controller', 'Controller', false);

if (!class_exists("ErrorHandler")) {
	require_once CAKE . DS . 'error.php';
}

require CORE_PATH . 'dispatcher.php';

// Sets the initial router state so future reloads work.
Router::reload();
