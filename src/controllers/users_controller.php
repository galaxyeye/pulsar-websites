<?php

class UsersController extends AppController {

	public $components = array('RequestHandler', 'Session', 'Email');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'nominate', 'register', 
			'checkEmail', 'checkNickname', 'checkLogin', 
			'login', 'autoLogin', 'logout', 'autoLogout',
			'activate', 'resetPassword','retrievePassword', 
			'admin_login',
	  		'admin_logout',
			'securimage', 'serialize',
			'register_ok', 'ajaxRegister', 'testRegister');
	}

	public function mine() {
		
	}

	/**
	 * serialize the object in json format
	 *
	 * @param string $id Id of the user to be jsonify, if $id is null, return current user
	 * @return string
	 */
	protected function jsonify($id = null) {
		if ($id == null) {
			return json_encode(array('User' => $this->currentUser));
		}
		else {
			$this->User->recursive = -1;
			$data = $this->User->read(null, $id);
			unset($data['User']['password']);
			return json_encode($data);
		}
	}

	public function index(){
		$this->paginate['User'] = array('limit'=> 500, 'order' => 'User.id DESC');

		if (!isset($this->params['url']['status'])) {
			$this->set('users', $this->paginate());
		}
		else {
			$status = isset($this->params['url']['status']) ? $this->params['url']['status'] : null;
			$group = isset($this->params['url']['group']) ? $this->params['url']['group'] : null;
			$sY = isset($this->params['url']['sY']) ? $this->params['url']['sY'] : '';
			$sM = isset($this->params['url']['sM']) ? $this->params['url']['sM'] : '';
			$sD = isset($this->params['url']['sD']) ? $this->params['url']['sD'] : '';
			$eY = isset($this->params['url']['eY']) ? $this->params['url']['eY'] : '';
			$eM = isset($this->params['url']['eM']) ? $this->params['url']['eM'] : '';
			$eD = isset($this->params['url']['eD']) ? $this->params['url']['eD'] : '';
			$type = isset($this->params['url']['type']) ? $this->params['url']['type'] : null;
			$key = isset($this->params['url']['key']) ? $this->params['url']['key'] : null;

			$start = $sY.$sM.$sD;
			$end = $eY.$eM.$eD;

			$conditions = array();
			$conditions['AND']['User.created BETWEEN ? AND ?'] = array($start, $end);

			if ($status != 'ALL'){
				$conditions['AND']['User.status'] = $status;
			}

			if ($group != 'ALL' && is_numeric($group)){
				$conditions['AND']['User.group_id'] = $group;
			}

			if ($type != 'NONE' && !empty($type)) {
				$conditions['AND']['User.'.$type.' LIKE '] = '%%'.$key.'%%';
			}

			$this->set('users', $this->paginate($conditions));
		}

		$default = array('ALL' => 'ALL');
		$this->set('groups', $default + $this->User->Group->find('list'));
	}

	public function admin_index(){
		$this->paginate['User'] = array('limit'=> 500, 'order' => 'User.id DESC');

		if (!isset($this->params['url']['status'])){
			$this->set('users', $this->paginate());
		}
		else {
			$status = isset($this->params['url']['status']) ? $this->params['url']['status'] : null;
			$group = isset($this->params['url']['group']) ? $this->params['url']['group'] : null;
			$sY = isset($this->params['url']['sY']) ? $this->params['url']['sY'] : '';
			$sM = isset($this->params['url']['sM']) ? $this->params['url']['sM'] : '';
			$sD = isset($this->params['url']['sD']) ? $this->params['url']['sD'] : '';
			$eY = isset($this->params['url']['eY']) ? $this->params['url']['eY'] : '';
			$eM = isset($this->params['url']['eM']) ? $this->params['url']['eM'] : '';
			$eD = isset($this->params['url']['eD']) ? $this->params['url']['eD'] : '';
			$type = isset($this->params['url']['type']) ? $this->params['url']['type'] : null;
			$key = isset($this->params['url']['key']) ? $this->params['url']['key'] : null;

			$start = $sY.$sM.$sD;
			$end = $eY.$eM.$eD;

			$conditions = array();
			$conditions['AND']['User.created BETWEEN ? AND ?'] = array($start, $end);

			if ($status != 'ALL'){
				$conditions['AND']['User.status'] = $status;
			}

			if ($group != 'ALL' && is_numeric($group)){
				$conditions['AND']['User.group_id'] = $group;
			}

			if ($type != 'NONE' && !empty($type)) {
				$conditions['AND']['User.'.$type.' LIKE '] = '%%'.$key.'%%';
			}

			$this->set('users', $this->paginate($conditions));
		}

		$default = array('ALL' => 'ALL');
		$this->set('groups', $default + $this->User->Group->find('list'));
	}

	public function admin_view($id = null) {
		$this->set('user', $this->User->read(null, $id));
	}

	public function admin_activate($id = null) {
		$this->User->id = $id;
		$this->User->saveField('status', 'ACTIVATED');

		$user = $this->User->read(null, $id);
		
		$data = array(
			'status' => 'ACTIVATED',
			'point' => 0,
			'level' => 0,
			'exp' => 0
		);
		
		$this->User->save($data);

		$this->redirect(array('controller' => 'users', 'action' => 'view', $user['User']['id']));
	}

	public function checkLogin() {
		echo 'isLogin='.(($this->currentUser['id'] != 0) ? '1' : '0');

		Configure::Write('debug', 0);
		$this->autoRender = false;
	}

	public function checkEmail(){
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->data)){
				$email = $this->data;
				$count = $this->User->find('count', 
					array(
						'conditions' => array('User.email' => $email)
					)
				);

				if (0 != $count){
					echo 'used';
				}
				else{
					echo 'not used';
				}
			}
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function checkNickname() {
		if (!empty($this->data)){
			$name = $this->data;
			$count = $this->User->find('count', 
			array(
				'conditions' => array('User.name' => $name)
				)
			);
	
			if (0 != $count){
				echo 'used';
				}
			else{
				echo 'not used';
			}
		}
		
		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function register($register_key = ''){
		$canRegister = false;
	}

	public function register_ok($email='', $eurl=''){
		$this->set('email', $email);
		$this->set('eurl', $eurl);
	}

	public function ajaxRegister() {
		Configure::Write('debug', 0);
		$this->autoRender = false;

		if (!(isset($this->params['form']['email']) && isset($this->params['form']['name']) &&
			isset($this->params['form']['password']) && isset($this->params['form']['code']))) {
			$response = array('validate' => false, 'message' => '注册失败！你提交的信息不完整，请检查更正后重试！');
		}
		else if (empty($this->params['form']['email']) || empty($this->params['form']['name']) || 
			empty($this->params['form']['password'])) {
			$response = array('validate' => false, 'message' => '注册失败！你提交的信息不完整，请检查更正后重试！');
		}
		else if (!$this->captcha->check($this->params['form']['code'])){
			$response = array('validate' => false, 'message' => '注册失败！你填写的验证码有误，请检查更正后重试！');
		}
		else {
			$email = $this->params['form']['email'];
			$name = $this->params['form']['name'];
			$password = $this->params['form']['password'];

			$response = $this->__doAjaxRegister($email, $name, $password);
		}

		echo json_encode($response);
	}

	public function testRegister($password = null) {
		Configure::Write('debug', 1);

		$email = genRandomString(5).'-'.rand(10000, 100000).'@logoloto.com';
		$name = genRandomString(5).'-'.rand(10000, 100000);

		if ($password == null) $password = 'abc123';

		$response = $this->__doSimpleRegister($email, $name, $password);

		die();
	}

	private function __doAjaxRegister($email, $name, $password) {
		$response = array('validate' => true, 'message' => '');

		$this->User->recursive = -1;
		$count = $this->User->find('count', array('conditions' => array('User.email' => $email)));
		if ($count != 0) { 
			$this->log('Email has been used', LOG_ERR);
			$response['validate'] = false;
			$response['message'] = '注册失败！你填写的Email已被注册，请更换Email！';

			return $response;
		}

		$count = $this->User->find('count', array('conditions' => array('User.name' => $name)));
		if ($count != 0) { 
			$this->log('Register failure: Name has been used', LOG_ERR);
			$response['validate'] = false;
			$response['message'] = '注册失败！你填写的会员名已被使用，请更换会员名！';

			return $response;
		}

		// Create a new user
		$this->User->Group->recursive = -1;
		$group = $this->User->Group->findByName('user', array('fields' => 'Group.id'));

		$user['User']['email'] = $email;
		$user['User']['name'] = $name;
		$user['User']['password'] = $this->Auth->password($password);
		$user['User']['point'] = 0;
		$user['User']['level'] = 0;
		$user['User']['exp'] = 0;
		$user['User']['status'] = 'CREATED';
		$user['User']['group_id'] = $group['Group']['id'];
		$user['User']['avatar'] = AVATAR_DEFAULT;
		$user['User']['referrer'] = 0;

		if ($this->User->save($user)){
		}
		else {
			$this->log('Failed to save user, registration failure', LOG_ERR);
			$response['validate'] = false;
			$response['message'] = '注册失败！可能是网络连接有问题，请稍后再试！';
		}

		return $response;
	}

	private function __doSimpleRegister($email, $name, $password) {
		$response = array('validate' => true, 'message' => '');

		$this->User->recursive = -1;

		// Ipv6
		$ip = CLIENT_IP;

		// Create a new user
		$user['User']['email'] = $email;
		$user['User']['name'] = $name;
		$user['User']['password'] = $this->Auth->password($password);
		$user['User']['point'] = 0;
		$user['User']['level'] = 0;
		$user['User']['exp'] = 0;
		$user['User']['status'] = 'CREATED';
		$user['User']['group_id'] = 4;
		$user['User']['avatar'] = AVATAR_DEFAULT;
		$user['User']['referrer'] = 4;
		$user['User']['ip'] = $ip;

		if ($this->User->save($user)){
		}
		else {
			$this->log('Failed to save user, registration failure', LOG_ERR);
			$response['validate'] = false;
			$response['message'] = '注册失败！可能是网络连接有问题，请稍后再试！';
		}

		return $response;
	}

	private function __getReferrer() {
		// Prepare user data
		// Who is the inviter ?
		$referrer = 0;
		if ($this->Session->check('Invitation.inviter_id')) {
			$timestamp = $this->Session->read('Invitation.timestamp');
			if ($timestamp - $_SERVER['REQUEST_TIME'] < DAY) {
				$referrer = $this->Session->read('Invitation.inviter_id');
			}

			$this->Session->delete('Invitation');
		}
		else if ($this->Session->check('Channel.channel_id')) {
			$timestamp = $this->Session->read('Channel.timestamp');
			if ($timestamp - $_SERVER['REQUEST_TIME'] < HOUR) {
				$referrer = $this->Session->read('Channel.channel_id');
			}
		}

		if ($referrer == 0) {
			$referrer = isset($this->params['form']['referrer']) ? $this->params['form']['referrer'] : 0;
		}

		return $referrer;
	}

	private function __getEurl($email) {
		$domain = substr(strstr($email, '@'), 1);
		// Get the email agent entrance
		include_once(CONFIGS . 'email.php');

		$agent = new EMAIL_AGENT();
		$entrances = $agent->entrance;

		if (array_key_exists($domain, $entrances)) {
			return $entrances[$domain];
		}
		else {
			return '';
		}
	}

	private function __afterRegister($user) {
		// 1. Older login user logout
		if ($this->Cookie->read(COOKIE_NAME.'['.TOOL_BAR_COOKIE_NAME.']')) {
			$this->Cookie->delete(COOKIE_NAME.'['.TOOL_BAR_COOKIE_NAME.']');
		}
		if ($this->Cookie->read(COOKIE_NAME.'['.MESSENGER_COOKIE_NAME.']')) {
			$this->Cookie->delete(COOKIE_NAME.'['.MESSENGER_COOKIE_NAME.']');
		}
		if ($this->currentUser['id'] > 0) {
			$this->Auth->logout();
		}
	}

	public function activate($hint = null){
		if (is_numeric($hint)) {
			$verson = 2;
		}
		else if (is_string($hint)) {
			$verson = 1;
		}
		else {
			$this->cakeError('invalidArgument');
		}
		$sid = isset($this->params['url']['sid']) ? $this->params['url']['sid'] : false;

		$this->User->recursive = -1;
		if ($verson <= 1) {
			$userInfo = explode('&', base64_decode($hint));
			$email = substr($userInfo[0], strlen('usr='));
			$password = substr($userInfo[1], strlen('pw='));

			$user = $this->User->find('first', array(
			    'fields' => array('id', 'email', 'password', 'name', 'status', 'created', 'referrer'),
				'conditions' => array('email' => $email))
		    );
		}
		else {
			$user = $this->User->read(array('id', 'email', 'password', 'name', 'status', 'created', 'referrer'), $hint);

			$email = $user['User']['email'];
			$password = $user['User']['password'];
		}

		if (empty($user)) {
			$this->set('message', "错误的激活链接！");
		}
		else if ($verson > 1 && $sid && md5($email.Configure::read('Security.salt').$this->Auth->password($password)) != $sid) {
			$this->set('message', "错误的激活链接！");
		}
		else if ($user['User']['status'] != 'CREATED') {
			$this->set('message', "帐号已经被激活！");
		}
		else if ((strtotime('now') - strtotime($user['User']['created']) > ACCOUNT_ACTIVATION_EMAIL_EXPIRED)) {
			$profile = $this->User->Profile->find('first', 
				array('fields' => array('id'), 'conditions' => array('user_id' => $user['User']['id'])));
			if (!empty($profile)) {
				$this->User->Profile->delete($profile['Profile']['id']);
			}
			$this->User->delete($user['User']['id']);

			$this->set('message', "激活链接已经过期，请重新注册！");
		}
		else if ($user['User']['password'] != $password) {
			$this->set('message', "错误的激活链接！");
		}
		else if($user['User']['password'] == $password) {
			$this->__doActive($user);
		}
		else {
			$this->log('Failed to active the account with unknown reason');
			$this->set('message', __('Failed to active the account with unknown reason', true));
		}
	}

	private function __doActive($user) {
	    // 1. 更新状态
		$this->User->id = $user['User']['id'];
		$data = array(
			'status' => 'ACTIVATED',
			'point' => 0,
			'level' => 0,
			'exp' => 0
		);
		$this->User->save($data);
		$this->set('message', '恭喜你！帐户已被激活！请登录乐够乐透网开始你的奇妙旅程吧:)');
		$this->set('result', 'activated');

		// 2. 自动登录
		$user['User']['status'] = 'ACTIVATED';
		$user['User']['point'] = 0;
		$user['User']['level'] = 0;
		$user['User']['exp'] = 0;
		unset($user['User']['password']);
		$this->_updateUser($user['User']);
		$this->Session->write($this->Auth->sessionKey, $this->currentUser);

		// 3. 提醒系统: 提醒用户填写个人消息
		// fts : fresh tutorial step
		$toolBarCookie = 'lstMsgT='.time().'&msgid=fts&fts=activate';
		$cookieName = TOOL_BAR_COOKIE_NAME.$this->currentUser['id'];
		$this->Cookie->write($cookieName, $toolBarCookie, false, '1 day');

		// 4. Promotion Channel
		if ($this->Session->check('Channel')) {
			App::import('Lib', 'promotion_manager');
			$channel = $this->Session->read('Channel');

			$this->loadModel('CorpUser');
			$corpUser = array(
				'channel_id' => $channel['channel_id'],						// 1
				'session_id' => $channel['session_id'],						// 2
				'date' => date('Y-m-d', $_SERVER['REQUEST_TIME']),			// 3
				'time' => date('H:i:s', $_SERVER['REQUEST_TIME']),			// 4
				'info' => $channel['info'],									// 5
				'cookie' => isset($_COOKIE['LTINFO']) ? $_COOKIE['LTINFO'] : '',	// 6
				'user_id' => $user['User']['id'],							// 7
				'user_name' => $user['User']['name'],						// 8
				'user_referrer' => $user['User']['referrer'],				// 9
				'order_code' => $user['User']['id'],						// 10
				'category_code' => $user['User']['referrer'],				// 11
				'ip' => CLIENT_IP,									// 12
				'referrer' => $this->referer(),								// 13
				'stat' => 3 												// 14	0 : error, 1 : visit, 2 : register, 3 : activate, 4 : profile
			);

			if ($this->CorpUser->save($corpUser)) {
				if ($channel['channel_id'] == $user['User']['referrer']) {
					$this->set('channel', $channel);
				}
				else {
					$this->log('Channel id and user referrer unmatch, the user is '.$user['User']['id']);
				}

				$this->Session->delete("Channel");
			}
			else {
				$this->log('Failed to save corp user, the user is '.$user['User']['id']);
			}
		}
	}

	public function retrievePassword(){
		if (!empty($this->data)) {
			if ($this->captcha->check($this->data['User']['secure_code']) == false) {
				$this->set('authMessage', __('Incorrect security code, please try again.', true));
			}
			else {
				$this->User->recursive = -1;
				$email = $this->data['User']['email'];
				$user = $this->User->find('first', array('conditions' => array('email' => $email)));
				if (empty($user)) {
					$this->set('authMessage', __('No such account', true));
				}
				else {
					$this->__sendUsersRetrievePasswordMail($user['User']);
					$this->set('user', $user);
					$this->set('resetStatus', 'MAIL_SENT_OUT');
					$this->render('resetpw_msg');
				}
			}
		}
	}

	public function resetPassword($hint = null) {
		if (!empty($this->data)) {
			$userInfo = explode('&', base64_decode($this->data['User']['hint']));
			$email = substr($userInfo[0], strlen('usr='));
			$password = substr($userInfo[1], strlen('pw='));
			$time = substr($userInfo[2], strlen('t='));

			$this->User->recursive = -1;
			$user = $this->User->find('first', 
				array('fields' => array('id', 'password', 'created', 'status'), 'conditions' => array('email' => $email)));

			if (empty($user) || $user['User']['status'] != 'ACTIVATED' 
				|| (time() - $time) > PASSWORD_RESET_EMAIL_EXPIRED
				|| $user['User']['password'] != $password) {
				$this->set('resetStatus', 'INVALID_LINK');
			} else if($user['User']['password'] == $password) {
				if ($this->data['User']['password'] == $this->data['User']['confirm_password']) {
					$this->User->id = $user['User']['id'];
					$this->data['User']['password'] = $this->data['User']['confirm_password'];
					$this->User->saveField('password', $this->Auth->password($this->data['User']['password']));

					$this->set('resetStatus', 'RESET_PASSWORD_OK');
				} else {
					$this->set('resetStatus', 'PASSWORD_CONFLICT');
				}
			} else {
				$this->log('Failed to reset password with unknown reason');
			}

			$this->render('resetpw_msg');
		}
		else if (is_string($hint)) {
			$userInfo = explode('&', base64_decode($hint));
			$email = substr($userInfo[0], strlen('usr='));
			$password = substr($userInfo[1], strlen('pw='));
			$time = substr($userInfo[2], strlen('t='));

			$this->User->recursive = -1;
			$user = $this->User->find('first', 
				array('fields' => array('id', 'password', 'created', 'status'), 'conditions' => array('email' => $email)));

			if (empty($user) || $user['User']['status'] != 'ACTIVATED' 
				|| (time() - $time) > PASSWORD_RESET_EMAIL_EXPIRED  
				|| $user['User']['password'] != $password) {
				$this->set('resetStatus', 'INVALID_LINK');
				$this->render('resetpw_msg');
			}
			else if($user['User']['password'] == $password) {
				$this->data['User']['hint'] = $hint;
			}
			else {
				$this->log('Failed to active the account with unknown reason');
			}
		}
		else {
			$this->cakeError('error404');
		}
	}

	public function securimage(){
        //override variables set in the component - look in component for full list 
		$this->captcha->image_height = 35;
		$this->captcha->image_width = 110;
		$this->captcha->image_bg_color = '#e1e1e1';
		$this->captcha->draw_lines = false;
	    $this->captcha->arc_line_colors = '#999999,#cccccc';
		$this->captcha->code_length = 4;
		$this->captcha->font_size = 18;
		$this->captcha->text_transparency_percentage = 25;
		$this->captcha->text_color = '#000000';
		$this->captcha->text_minimum_distance = 20;
		$this->captcha->text_maximum_distance = 25;
		srand ( $_SERVER ['REQUEST_TIME'] );
		$this->set ( 'captcha_data', $this->captcha->show () ); // dynamically creates an image
		
		Configure::write ( 'debug', 0 );
		$this->autoRender = false;
		exit ();
	}

	public function login() {
	}

	public function login2() {
	}

	public function logout() {
		$this->currentUser = DEFAULT_USER;
		$this->redirect($this->Auth->logout());
	}

	public function admin_login() {
	}

	public function admin_logout(){
		$this->redirect($this->Auth->logout());
	}
	
	public function loginService() {
		$id = isset($this->params['url']['id']) ? $this->params['url']['id'] : false;
		$s = isset($this->params['url']['s']) ? $this->params['url']['s'] : false;
		$status = isset($this->params['url']['st']) ? $this->params['url']['st'] : 0;
		$continue = isset($this->params['url']['continue']) ? $this->params['url']['continue'] : false;

		if ($id && $s && $status > 0 && $continue) {
			$this->User->recursive = -1;
			$user = $this->User->read(null, $id);
			if (md5($user['User']['password'].'-lol-'.$user['User']['id']) == $s) {
				// 自动登录
				$this->_updateUser($user['User']);
				$this->Session->write('Auth.User', $this->currentUser);

				$this->Cookie->domain = '.'.DOMAIN;
				$this->Cookie->write(MESSENGER_COOKIE_NAME, $this->currentUser, true, '11 years');

				$continue = preg_replace("/(&amp;)/i", '&', empty($continue) ? '/' : base64_decode($continue));
				$url = parse_url($continue);
				$continue = "http://$url[host]/member.php?mod=logging&action=login&xself=".$this->params['url']['continue'];
				$this->redirect($continue);
			}
			else {
				$this->Session->setFlash('用户名或密码错');
			}
		}

		$this->redirect('/users/login');
	}

	public function logoutService() {
		echo $this->Auth->logout();

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function autoLogin(){
		$id = isset($this->params['url']['id']) ? $this->params['url']['id'] : false;
		$s = isset($this->params['url']['s']) ? $this->params['url']['s'] : false;
		$continue = isset($this->params['url']['continue']) ? $this->params['url']['continue'] : '/';
		if ($continue = '') $continue = '/';

		$valid = false;
		if (!$id || !$s) {
			$this->redirect('/');
		}
		else {
			$this->User->recursive = -1;

			$user = $this->User->read(null, $id);
			$user['User']['gender'] = '';
			$user['User']['birth'] = '';
			$user['User']['salary'] = '';

			if (md5($user['User']['password'].'-lol-'.$user['User']['id']) == $s) {
				$valid = true;
			}

			if ($valid) {
				// 自动登录
				$this->_updateUser($user['User']);
				$this->Session->write('Auth.User', $this->currentUser);

				$this->autoRender = false;
				$this->redirect($continue, null, false);
			}
			else {
				$this->redirect('/');
			}
		}
	}

	public function autoLogout() {
		$continue = isset($this->params['url']['continue']) ? $this->params['url']['continue'] : '/';
		$this->Auth->logout();
		$this->redirect($continue);
	}

	public function admin_removeAccount($email) {
		$this->User->recursive = -1;
		$user = $this->User->find('first', 
			array('fields' => array('id', 'password', 'created', 'status'), 'conditions' => array('email' => $email)));

		if (!empty($user)) {
			$profile = $this->User->Profile->find('first', 
					array('fields' => array('id'), 'conditions' => array('user_id' => $user['User']['id'])));
			if (!empty($profile)) {
				if (!$this->User->Profile->delete($profile['Profile']['id'])) {
					die('Failed to remove profile for <'.$email.'>');
				}
			}
	
			if (!$this->User->delete($user['User']['id'])) {
				die('Failed to remove account <'.$email.'>');
			}
			die('Account <'.$email.'> has been removed');
		}
		else {
			die('The account <'.$email.'> does not exists');
		}
	}

	public function admin_changeGroup(){
		$actor = $this->Session->read('Auth.User');
		$this->log('User ['.$actor['email'].'] is attempt to change privilege', LOG_NOTICE);

		$root = $this->User->Group->findByName('root');
		$supperuser = $this->User->Group->findByName('supperuser');
		if (empty($this->data)){
			$this->flash(__('Incomplete data', true), array('action'=>'index'));
		}
		else if ($supperuser['Group']['id'] === $actor['group_id'] || $root['Group']['id'] === $actor['group_id']) {
			// Only supperuser or root user have privilege to change one's group

			// Check if the group is changed
			$this->User->id = $this->data['User']['id'];
			$oldgroupid = $this->User->field('group_id');
			if ($oldgroupid !== $this->data['User']['group_id']) {
				// Can not change to root group using web
				if ($root['Group']['id'] !== $this->data['User']['group_id']){
				    $aro = &$this->Acl->Aro;
					$user = $aro->findByForeignKeyAndModel($this->data['User']['id'], 'User');
					$group = $aro->findByForeignKeyAndModel($this->data['User']['group_id'], 'Group');

				    // Save to ARO table
					$aro->id = $user['Aro']['id'];
					if ($aro->save(array('parent_id' => $group['Aro']['id']))){
						if ($this->User->saveField('group_id', $this->data['User']['group_id'])){
							$this->flash(__('User group has been changed', true), array('action'=>'index'));
				    	}
				    	else {
							$this->flash(__('Failed to change user group', true), array('action'=>'index'));
				    	}
					}
				    else {
						$this->flash(__('Failed to change privilege', true), array('action'=>'index'));
				    }// end if $aro
				}// end if $root
				else {
					$this->flash(__('Can not change to root group', true), array('action'=>'index'));
				}
			}// end if $oldgroupid
			else {
				$this->flash(__('You did not change the privilege', true), array('action'=>'index'));
			}
		}
		else {
			$this->flash(__('You are not privileged to do this', true), array('action'=>'index'));
		}
	}

	public function admin_edit($id = null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}

		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->flash(__('The User has been saved', true), array('action'=>'index'));
			} else {
				$this->flash(__('The User could not be saved. Please, try again.', true), array('action'=>'index'));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			$this->set('groups', $this->User->Group->find('list'));
		}
	}

    public function admin_sendUsersRegisterMail($id) {
	    $user = $this->User->read(null, $id);
		$this->__sendUsersRegisterMail($user['User']);

		$this->redirect($this->referer());
    }

	private function __sendUsersRetrievePasswordMail($user) {
	    $resetPasswordLink = '/users/resetPassword/'.base64_encode('usr='.$user['email'].'&pw='.$user['password'].'&t='.time());
	    $this->set('resetPasswordLink', $resetPasswordLink);
	    $this->set('user', $user);

		loadEmailSettings('usersRetrievePassword', $this->Email);
		if (OPEN_MAIL) {
		$this->Email->to = $user['email'];
		}
	    $this->Email->send();

	    if ($this->Email->smtpError) {
			$this->log('Failed to send email to'.$user['email'].'\\n\\tDetailed information:['.$this->Email->smtpError.']', LOG_ALERT);
	    }
	}
    
	private function __queueUsersRegisterMail($user) {
		$sid = md5($user['email'].Configure::read('Security.salt').$this->Auth->password($user['password']));
	    $activeLink = '/users/activate/'.$user['id'].'?sid='.$sid;

   		$this->UserEvent->setParams(
			array('allow' => array('email_notify' => true), 
				'recipients' => array(array('User' => $user)),
				'activeLink' => $activeLink
		));
    }
}
?>
