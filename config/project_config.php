<?php

// version
define('VERSION', '0.90');

// database deploy
define('STAT_DB', 'default');

/**
 * Environment information
 * */
define('TIME_START', time());

define('CURRENT_TIME_ZONE', 'Asia/Shanghai');
define('CURRENT_TIME_ZONE_OFFSET_HOURS', +8);

// System directories
define("GLOBAL_DATA_DIR", "/tmp/warps");
define("ROOT_DATA_DIR", GLOBAL_DATA_DIR . "/satellite");

/**
 * Global configuration
 * */
define('DEFAULT_LAYOUT', 'default');
define('DEFAULT_TITLE', 'Warp Speed Controller');
define('DEFAULT_KEYWORDS', 'Warp Speed Controller');
define('DEFAULT_DESCRIPTION', 'Warp Speed Controller');

// Account
define('ACCOUNT_ACTIVATION_EMAIL_EXPIRED', 60 * DAY);
define('PASSWORD_RESET_EMAIL_EXPIRED', 3 * DAY);

// User
define('USER_ANONYMOUS_NAME', '游客');
define('USER_ANONYMOUS_EMAIL', 'anonymous@anonymous.net');
define('ROOT_ACCOUNT', 'root@logoloto.com');
define('SYSTEM_ACCOUNT', 'system@logoloto.com');

define('REGISTER_LIMIT_PER_IP', 100);

// Group Definition, Must Keep Consistent With The Database
define('ROOT_GROUP_ID', 1);
define('SUPPERUER_GROUP_ID', 2);
define('MANAGER_GROUP_ID', 3);
define('USER_GROUP_ID', 4);
define('ENTERPRISE_GROUP_ID', 5);
define('SYSTEM_GROUP_ID', 6);

define('ALL_ACCOUNT_REFERRER', 1);
define('TEST_ACCOUNT_REFERRER', 2);
define('SHADOW_ACCOUNT_REFERRER', 4);
define('LUCKY_ACCOUNT_REFERRER', 8);
define('FRIEND_ACCOUNT_REFERRER', 9);

// Avatar
define('AVATAR_PREDEFINED_ROOT', 'avatars/predefined/');
define('AVATAR_DEFAULT', AVATAR_PREDEFINED_ROOT . 'default.gif');
define('AVATAR_PREDEFINED_MAX', 40);

// Cookie
define('COOKIE_NAME', 'warp.speed.management');
define('COOKIE_KEY', 'wsiTIx32bs!2*woi!');

// Javascript
define('COMMON', 'common');
define('JSON2', 'json2');
define('DUMP', 'dump');

define('JQUERY', 'jquery/jquery-1.11.4');
define('JQUERY_UI', 'jquery/jquery-ui-1.11.4');
define('JQUERY_UI_CSS', 'jquery/jquery-ui-1.11.4');
define('JSRENDER', 'jquery/jsrender');
define('LAYER', 'layer-v2.4/layer/layer');
