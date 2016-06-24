<?php 
  // version
  define('VERSION', '0.90');

  // database deploy
  define('STAT_DB', 'default');

  define('DEBUG_REMOTE_SERVER', true);
  define('DEBUG_HTTP_CLIENT', true);

  $host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : 
  	(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');

  define('HOST', $host);

  // $host is '' when run script
  if ($host == '' || $host == 'localhost' || 0 === strpos($host, '192.168') || 0 === strpos($host, '127.0')) {
    define('DOMAIN', 'localhost');

    define('URL_BASE', 'http://'.$host);
  }
  else {
    $pos = strpos($host, '.');
    if ($pos !== false) {
      define('DOMAIN', substr($host, $pos + 1));
    }
    else {
      define('DOMAIN', $host);
    }

    define('URL_BASE', 'http://www.'.DOMAIN);
  }

  if (!DEBUG_REMOTE_SERVER && DOMAIN == 'localhost') {
	  define('QIWU_NUTCH_SERVER', "http://localhost:8182");
	  define('QIWU_SCENT_SERVER', "http://localhost:8181");
  }
  else {
  	define('QIWU_NUTCH_SERVER', "http://master:8182");
  	define('QIWU_SCENT_SERVER', "http://master:8181");
  }

  define('DEFAULT_LAYOUT', 'default');
  define('DEFAULT_TITLE', 'nutch ui');
  define('DEFAULT_KEYWORDS', 'nutch ui');
  define('DEFAULT_DESCRIPTION', 'nutch ui');

  define('LOCK_DIR', TMP . 'locks' . DS);

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

  // Predifined Tags, Must Keep Consistent With The Database
  define('TAG_SYSTEM_TYPE', 1);
  define('TAG_SYMBOL_TYPE', 2);
  define('TAG_CUSTOMER_TYPE', 3);

  // Category
  define('CATEGORY_ROOT_ID', 1);
  define('CATEGORY_AIRCONDITIONER_ID', 2);
  define('CATEGORY_WATERPROOFING_ID', 3);
  define('CATEGORY_RECYCLE_ID', 4);

  // Avatar
  define('AVATAR_PREDEFINED_ROOT', 'avatars/predefined/');
  define('AVATAR_DEFAULT', AVATAR_PREDEFINED_ROOT.'default.gif');
  define('AVATAR_PREDEFINED_MAX', 40);

  // Cookie
  define('COOKIE_NAME', 'qiwur-data-ui');
  define('COOKIE_KEY', 'iTIx32bs!2*woi!');

  // Javascript
  define('COMMON', 'common');

  define('JSON2', 'json2');
  define('DUMP', 'dump');

  define('JQUERY', 'jquery/jquery-1.11.2');
  define('JQUERY_UI', 'jquery/jquery-ui-1.11.3/jquery-ui');
  define('JSRENDER', 'jquery/jsrender');
  define('LAYER', 'layer-v1.8.5/layer/layer.min');

  // Programing control
  define('BAIDU_MAP', 'http://api.map.baidu.com/api?v=1.2');
  define('GOOGLE_MAP', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyBr-GLMowalQV8XsRVlIm6Qni0R0rYLI0o&amp;sensor=false&language=en');

  // if false, all email will send to system admin
  define('OPEN_MAIL', false);
  // if false, just try login and do not send the message
  define('OPEN_SMS', false);

  // NUTCH config
  //  define('NUTCH_SERVER', "http://master:8081");
  define('NUTCH_SERVER', QIWU_NUTCH_SERVER);
  define('QIWU_UI_CRAWL_ID', "qiwu.ui.crawl.id");
  define('STORAGE_CRAWL_ID', "storage.crawl.id");
  define('FETCHER_FETCH_MODE', "fetcher.fetch.mode");
  define('URLFILTER_REGEX_RULES', "urlfilter.regex.rules");
  define('CRAWL_FILTER_RULES', "crawl.filter.rules");

  // SCENT specified constants
  define('SCENT_SERVER', QIWU_SCENT_SERVER);
  define('SCENT_FILE_SERVER', "http://qiwur.local");
  define('SCENT_OUT_DIR_RULED_EXTRACT', "/extract/ruled");
  define('SCENT_OUT_DIR_AUTO_EXTRACT', "/extract/auto");
  define('SCENT_OUT_DIR_WEB_CACHE', "/web");

  define('CONTENTFILTER_CONTENT_RULES', "contentfilter.content.rules");
