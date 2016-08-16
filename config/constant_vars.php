<?php

// TODO : find a third parth library to do this
if (!function_exists("get_server_info")) {
    function get_server_info() {
        $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] :
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
        $port = 80;

        $pos = strpos($host, ':');
        if ($pos !== false) {
            $port = substr($host, $pos + 1);
            $host = substr($host, 0, $pos);
        }

        // $host is '' when run script
        if ($host == '' || $host == 'localhost' || 0 === strpos($host, '192.168') || 0 === strpos($host, '127.0')) {
            $domain = "localhost";
            $url_base = "http://".$domain;
        }
        else {
            $pos = strpos($host, '.');
            if ($pos !== false) {
                $domain = substr($host, $pos + 1);
            }
            else {
                $domain = $host;
            }

            $url_base = "http://".$domain;
        }

        return compact("host", "port", "domain", "url_base");
    }
}

// version
define('VERSION', '0.90');

// database deploy
define('STAT_DB', 'default');

/**
 * Program switches
 * */
define('DEBUG_REMOTE_SERVER', false);
define('DEBUG_HTTP_CLIENT', false);

// define('OPEN_DEBUG_PANEL', true);
// if false, all email will send to system admin
define('OPEN_MAIL', false);
// if false, just try login and do not send the message
define('OPEN_SMS', false);

// Enable nutch job auto scheduler
define('ENABLE_NUTCH_JOB_AUTO_SCHEDULER', true);

// Load web pages from HDFS or from local disk, it's used for debug
define('STORAGE_WEB_PAGES_MODE', '');

define('STORAGE_CRAWL_ID_VALUE', 'information');

/**
 * Environment information
 * */
define('TIME_START', time());

$serverInfo = get_server_info();

define('HOST', $serverInfo['host']);
define('PORT', $serverInfo['port']);
define('DOMAIN', $serverInfo['domain']);
define('URL_BASE', $serverInfo['url_base']);

if (!DEBUG_REMOTE_SERVER && DOMAIN == 'localhost') {
    define('WAPRS_NUTCH_SERVER', "http://localhost:8182");
    define('WAPRS_SCENT_SERVER', "http://localhost:8181");
} else {
    define('WAPRS_NUTCH_SERVER', "http://master:8182");
    define('WAPRS_SCENT_SERVER', "http://master:8181");
}

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

define('JQUERY', 'jquery/jquery-1.11.2');
define('JQUERY_UI', 'jquery/jquery-ui-1.11.3/jquery-ui');
define('JSRENDER', 'jquery/jsrender');
define('LAYER', 'layer-v2.4/layer/layer');

// Programing control
define('BAIDU_MAP', 'http://api.map.baidu.com/api?v=1.2');
define('GOOGLE_MAP', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyBr-GLMowalQV8XsRVlIm6Qni0R0rYLI0o&amp;sensor=false&language=en');

// System directories
define("GLOBAL_DATA_DIR", "/tmp/warps");
define("ROOT_DATA_DIR", GLOBAL_DATA_DIR . "/satellite");

/**
 * Web service proxy
 * */
// NUTCH
define('NUTCH_SERVER', WAPRS_NUTCH_SERVER);
define('QIWU_UI_CRAWL_ID', "qiwu.ui.crawl.id");
define('STORAGE_CRAWL_ID', "storage.crawl.id");
define('FETCHER_FETCH_MODE', "fetcher.fetch.mode");
define('URLFILTER_REGEX_RULES', "urlfilter.regex.rules");
define('CRAWL_FILTER_RULES', "crawl.filter.rules");
define('CONTENTFILTER_CONTENT_RULES', "contentfilter.content.rules");

// SCENT
define('SCENT_SERVER', WAPRS_SCENT_SERVER);
define('SCENT_FILE_SERVER', "http://qiwur.local");
define('SCENT_OUT_DIR_RULED_EXTRACT', "/extract/ruled");
define('SCENT_OUT_DIR_AUTO_EXTRACT', "/extract/auto");
define('SCENT_OUT_DIR_WEB_CACHE', "/web");

define('NUTCH_MASTER_PORT', 8182);
define('SCENT_MASTER_PORT', 8181);

# define('NUTCH_MASTER_SERVICE', "http://" . NUTCH_SERVER . ":" . NUTCH_MASTER_PORT);

// HADOOP
define('HDFS_NAME_NODE_SERVER', "master");
define('HDFS_NAME_NODE_PORT', 50070);
define('HDFS_DATA_NODE_PORT', 50075);
define('HDFS_SECONDARY_NAME_NODE_PORT', 50090);
define('HDFS_BACKUP_NODE_PORT', 50105);

define('MR_JOB_TRACKER_PORT', 50030);
define('MR_TASK_TRACKER_PORT', 50060);

define('YARN_RESOURCE_MANAGER_PORT', 8088);
define('MAPREDUCE_JOBHISTORY_SERVER_PORT', 19888);

// HBASE
define('HBASE_HMASTER_SERVER', "master");
define('HBASE_HMASTER_PORT', 60010);
define('HBASE_HREGIONSERVER_PORT', 60030);

// SOLR
define('SOLR_ADMIN_SERVER', "master");
define('SOLR_ADMIN_PORT', 8983);
