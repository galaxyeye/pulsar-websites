<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 16-8-16
 * Time: 下午11:34
 */

/**
 * TODO : move the configurations to database
 */

$serverInfo = get_server_info();

define('HOST', $serverInfo['host']);
define('PORT', $serverInfo['port']);
define('DOMAIN', $serverInfo['domain']);
define('URL_BASE', $serverInfo['url_base']);

/**
 * Web service proxy
 * */
// SOLR
define('SOLR_ADMIN_SERVER', "master");
define('SOLR_ADMIN_PORT', 8983);
define('SOLR_URL_BASE', "http://" . SOLR_ADMIN_SERVER . ':' . SOLR_ADMIN_PORT . '/solr');
define('SOLR_COLLECTION', "information_1101_integration_test");
