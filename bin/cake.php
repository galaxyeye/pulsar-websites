#!/usr/bin/php -q
<?php

# include dirname(__DIR__) . '/config/bootstrap.php';

/**
 * Configure paths required to find CakePHP + general filepath
 * constants
 */
require __DIR__ . '/../config/paths.php';

// Use composer to load the autoloader.
require ROOT . DS . 'vendor' . DS . 'autoload.php';

/**
 * Bootstrap CakePHP.
 *
 * Does the various bits of setup that CakePHP needs to do.
 * This includes:
 *
 * - Registering the CakePHP autoloader.
 * - Setting the default application paths.
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

require CORE_PATH . "console/cake.php";

require CORE_PATH . 'console' . DS . 'error.php';

exit(ShellDispatcher::run($argv));
