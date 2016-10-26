<?php

/**
 * Program switches
 * */
define('DEBUG_REMOTE_SERVER', false);
define('DEBUG_HTTP_CLIENT', true);

// Enable nutch job auto scheduler
define('ENABLE_NUTCH_JOB_AUTO_SCHEDULER', true);

// Load web pages from HDFS or from local disk, it's used for debug
define('STORAGE_WEB_PAGES_MODE', '');

// define('OPEN_DEBUG_PANEL', true);
// if false, all email will send to system admin
define('OPEN_MAIL', false);
// if false, just try login and do not send the message
define('OPEN_SMS', false);
