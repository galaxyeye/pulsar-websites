#!/usr/bin/php -q
<?php

include dirname(__DIR__) . '/config/bootstrap.php';
include CORE_PATH . "console/cake.php";

exit(ShellDispatcher::run($argv));
