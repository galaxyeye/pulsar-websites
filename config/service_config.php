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

if (!DEBUG_REMOTE_SERVER && DOMAIN == 'localhost') {
    define('WAPRS_NUTCH_SERVER', "http://localhost:8182");
    define('WAPRS_SCENT_SERVER', "http://localhost:8181");
} else {
    define('WAPRS_NUTCH_SERVER', "http://master:8182");
    define('WAPRS_SCENT_SERVER', "http://master:8181");
}

/**
 * Web service proxy
 * */
// NUTCH
define('NUTCH_SERVER', WAPRS_NUTCH_SERVER);
define('QIWU_UI_CRAWL_ID', "qiwu.ui.crawl.id");
define('STORAGE_CRAWL_ID', "storage.crawl.id");
define('STORAGE_CRAWL_ID_VALUE', "information_0815_integration_test");
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

// Nutch
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
define('SOLR_URL_BASE', "http://" . SOLR_ADMIN_SERVER . ':' . SOLR_ADMIN_PORT . '/solr');
define('SOLR_COLLECTION', "information_1101_integration_test");
