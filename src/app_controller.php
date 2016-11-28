<?php
App::import('Lib', array('function_core', 'ip'));

// TODO : use a vendor library to do this
define('CLIENT_IP', IPv6ToIPv4MappedFormat(getRealRemoteIp()));

class AppController extends Controller {

  public $components = array(
    'Session', 'Acl', 'Auth', 'RequestHandler',
    'Cookie' => array('name' => COOKIE_NAME, 'key' => COOKIE_KEY, 'time' => 3600, 'path' => '/', 'secure' => false),
//    'Email',
//    'UserTracker',
//    'DebugKit.Toolbar'
  );

  // Default current user is anonymous user
  public $currentUser = array(
  		'id' => 0,
  		'email' => USER_ANONYMOUS_EMAIL,
  		'name' => USER_ANONYMOUS_NAME,
  		'password' => '',
  		'avatar' => AVATAR_DEFAULT,
  		'avatar_big' => AVATAR_DEFAULT,
  		'group_id' => USER_GROUP_ID,
  		'point' => 0, 'level' => 0, 'exp' => 0,
  		'created' => '1970-01-01 00:00:00', 'modified' => '1970-01-01 00:00:00',
  		'status' => 'ACTIVATED', 'gender' => '', 'birth' => '', 'referrer' => 0,
  		'salary' => '', 'ip' => '');

  public $settings = array();

  public $uniqueCookie = null;

  public function beforeFilter() {
    parent::beforeFilter();

    $this->settings = $this->_loadSettings();

    // Timezone setting
    date_default_timezone_set(CURRENT_TIME_ZONE);

    // Session accross all domain
    ini_set('session.cookie_domain', env('HTTP_BASE'));

    $this->Auth->allow('*');

    // Current user
    if ($this->Session->check('Auth.User')) {
      $this->_updateUser($this->Session->read('Auth.User'));
    }

    $this->_setAuth();

    // disable all cached item?
    // Cache::clear();
    
    // FIX mb_split/mbregex problem on aliyun servers : "mbregex compile err: invalid regular expression"
    // This problem does not see on dev machine.
    // TODO : check the difference between dev server and aliyun server
    mb_internal_encoding("UTF-8");
    mb_regex_encoding("UTF-8");
  }

  public function beforeRender() {
    // Current user
    $this->set('currentUser', $this->currentUser);
    $this->set('settings', $this->settings);

    $this->set('title_for_layout', DEFAULT_TITLE);
    $this->set('meta_keywords', DEFAULT_KEYWORDS);
    $this->set('meta_description', DEFAULT_DESCRIPTION);

    if (isset($this->params['named']['preview']) && $this->params['named']['preview']) {
      $this->layout = 'preview';
    }

    if ($this->isAdmin()) {
      $this->layout = 'admin';
    }

    if ($this->isAjax()) {
      $this->layout = 'ajax';
      $this->autoRender = false;
      $this->autoLayout = false;
    }

    if ($this->isAnonymous()) {
    	$this->layout = 'anonymous';
    }

    if ($this->isCustomer()) {
      // TODO : check account role
      $this->layout = 'customer';
    }

    // Javascript support is supplied by default
    // TODO : check if this is useful
    array_push($this->helpers, 'Js');
  }

  public function afterFilter() {
    $ACTION_LOG_OPEN = false;
    if ($ACTION_LOG_OPEN && $this->_needLogAction()) {
      $db =& ConnectionManager::getDataSource(STAT_DB);

      // Logging
      $sql = sprintf(<<<TAG
INSERT INTO `stat_accesses` (`controller`, `action`, `param1`, `param2`, `param3`, `ip`, `referer`, `uucookie`, `user_id`) 
TAG
          ."VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d)",
          $this->params['controller'], $this->params['action'],
          isset($this->params['pass'][0]) ? $this->params['pass'][0] : null,
          isset($this->params['pass'][1]) ? $this->params['pass'][1] : null,
          isset($this->params['pass'][2]) ? $this->params['pass'][2] : null,
          CLIENT_IP,
          isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
          $this->uniqueCookie,
          $this->currentUser['id']);
      $db->query($sql);
    } // if
  }

  /**
   * Serialization. The result is depend on the type
   *
   * @param string $id Id of the user to be serialized, if $id is null, return current user
   * @param string $type How to serialize the object, the possible type can be 'json', 'xml', 'string', 'variables', etc
   * 'json' and 'string' has been implemented currently
   * @access public
   */
  public function serialize($id = null, $type = 'json') {
    if ($type == 'json') {
      echo $this->jsonify($id);
    }
    else if ($type == 'xml') {
      // TODO
      echo 'not implemented';
    }
    else if ($type == 'printify') {
      $this->printify($id);
    }
    else {
      echo $this->toString();
    }

    Configure::write('debug', 0);
    $this->autoRender = false;
  }

  public function isAdmin() {
    return isset($this->params['prefix']) && ($this->params['prefix'] === 'admin');
  }

  /**
   * TODO : use RequestHandler
   * */
  public function isAjax() {
    return isset($this->params['prefix']) && ($this->params['prefix'] === 'ajax');
  }

  public function isCustomer() {
    return isset($this->params['prefix']) && ($this->params['prefix'] === 'u');
  }

  /**
   * TODO : use RequestHandler
   * */
  public function isAnonymous() {
  	return $this->currentUser['id'] == 0;
  	// return isset($this->params['prefix']) && ($this->params['prefix'] === 'anonymous');
  }

  /**
   * serialize the object in json format
   *
   * @param string $id Id of the user to be jsonify
   * @return string
   */
  protected function jsonify($id = null) {
    return json_encode($this->_load($id));
  }

  /**
   * serialize the object in print_r format
   *
   * @param string $id Id of the user to be printify
   * @access public
   */
  protected function printify($id = null) {
    echo '<pre>';
    print_r($this->_load($id));
    echo '</pre>';
  }

  protected function _load($id = null, $fields = null, $contain = null) {
    return array($id);
  }

  protected function _loadSettings() {
    if (($settings = Cache::read("settings", 'hourly')) === false) {
      $db =& ConnectionManager::getDataSource('default');
      $sql = <<<'TAG'
SELECT * FROM `settings` AS `Setting`
TAG;
      $settings = $db->query($sql);

      $settings2 = array();
      foreach ($settings as $setting) {
        $settings2[$setting['Setting']['skey']] = $setting['Setting']['svalue'];
      }

      $settings = $settings2;
      Cache::write("settings", $settings, 'hourly');
    }

    return $settings;
  }

  protected function _setAuth() {
    $this->Auth->fields = array('username' => 'email', 'password' => 'password');
    $this->Auth->authorize = 'actions'; // Every request will be checked using $this->Acl->check($aro, '/controllers/{controller}/{action}')
    $this->Auth->actionPath = 'controllers/';
    $this->Auth->userScope = array('User.status' => 'ACTIVATED');
    $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
    // $this->Auth->autoRedirect = false;
    $this->Auth->logoutRedirect = array('controller' => 'storage_page_entities', 'action' => 'index', 'anonymous' => true);

    // Specified Authorization
    if ($this->isAdmin()) {
      // Allways in debug mode
      ini_set("max_execution_time", "180");
      if (Configure::read() == 0) {
        Configure::write('debug', 1);
      }

      $this->Auth->loginAction = array('controller' => 'users', 'action' => 'admin_login');
    }

    if ($this->isCustomer()) {
      $this->Auth->loginAction = ['controller' => 'users', 'action' => 'login', 'u' => true];
      $this->Auth->logoutRedirect = ['controller' => 'users', 'action' => 'login', 'u' => true];
    }
  }

  protected function _needLogAction() {
    // This program need no log
    return false;

    $blackList = array('image', 'css', 'js');
    $controller = $this->params['controller'];
    if (in_array($controller, $blackList) || $this->isAdmin()) {
      return false;
    }

    return true;
  }

  protected function _updateUser($user) {
    if (!$user['id']) {
      return ;
    }

    $db =& ConnectionManager::getDataSource('default');
    $sql = <<<TAG
SELECT `User`.* FROM `users` AS `User` WHERE `User`.`id`=$user[id]
TAG;
    $data = $db->query($sql);
    $this->currentUser = array_merge($user, $data[0]['User']);
  }

  protected function redirect2Index($msg = '', $logLevel = false) {
    if ($logLevel && !empty($msg)) {
      $this->log($msg, $logLevel);
    }

    $this->Session->setFlash($msg);
    $this->redirect(array('action' => 'index'));
  }

  protected function redirect2View($id, $msg = '', $logLevel = false) {
    if ($logLevel && !empty($msg)) {
      $this->log($msg, $logLevel);
    }

    $this->Session->setFlash($msg);
    $this->redirect(array('action' => 'view', $id));
  }

  protected function _validateId($id, $redirect = ['action' => 'index']) {
    $modelClass = $this->modelClass;
    if (is_array($id)) {
      if (!isset($id[$modelClass]['id'])) {
        $id = false;
      }
      else {
        $id = $id[$modelClass]['id'];        
      }
    }

    if (!$id) {
      $this->Session->setFlash("Invalid ".$modelClass);
      $this->redirect($redirect);
    }

    if(!$this->checkTenantPrivilege($id)) {
      $this->Session->setFlash(__('Privilege denied', true));
      $this->redirect($redirect);
    }
  }

  /**
   * Multiple tenant support
   * @param $id integer The tenant user id
   * @param $modelClass string Model class name
   * @return boolean
   * */
  protected function checkTenantPrivilege($id, $modelClass = null) {
    if ($modelClass == null) {
      $modelClass = $this->modelClass;
    }

    if (empty($id)) {
      return false;
    }

    if (is_array($id)) {
      if (!isset($id[$modelClass]['id'])) {
        return false;
      }

      $id = $id[$modelClass]['id'];
    }

    // it's not a multi-tanent table
    if (!$this->{$modelClass}->hasField('user_id')) {
      return true;
    }

    $lastRecursive = $this->{$modelClass}->recursive;
    $this->{$modelClass}->recursive = - 1;
    $model = $this->{$modelClass}->read(array('user_id'), $id);
    $this->{$modelClass}->recursive = $lastRecursive;

    if ($model[$modelClass]['user_id'] !== $this->currentUser['id']) {
      return false;
    }

    return true;
  }

  // TODO : move to a library?
  protected function _tidyCrawlFilter($crawlFilters) {
    $tidiedCrawlFilters = array();

    foreach ($crawlFilters as $crawlFilter) {
      $this->loadModel('CrawlFilter');
      $crawlFilter = $this->CrawlFilter->tidyCrawlFilter($crawlFilter);

      if (!empty($crawlFilter)) {
        array_push($tidiedCrawlFilters, $crawlFilter);
      }
    }
  
    return $tidiedCrawlFilters;
  }
}
