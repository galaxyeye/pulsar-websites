<?php
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Logoloto(tm) :  The best CPA advertisement network (http://www.logoloto.com)
 * Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 *
 * @filesource
 * @copyright     Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)f
 */
?>
<?php
class LmailsController extends AppController {

	public $helpers = array('Fck');

  public $components = array('RequestHandler');

	public function beforeFilter() {
	    parent::beforeFilter();

	    $this->Auth->allow('printMandomTussand', 'viewMandomTussand', 'preview', 'subscribe', 'unsubscribe');
	}

	public $paginate = array('limit' => 70);

	public function preview() {
		if ($this->RequestHandler->isPost()) {
			if (!empty($this->data)) {
				$this->set('lmail', $this->data);
			}
		}
	}

	public function admin_index() {
		if (empty($this->data)){
			$this->set('lmails', $this->paginate(array('status' => array('PENDING', 'CONFIRMED'))));
		}
		else {
			$filter = $this->data['Filter'];
			$search = $this->data['Search'];

			$start = $filter['start']['year'].$filter['start']['month'].$filter['start']['day'];
			$end = $filter['end']['year'].$filter['end']['month'].$filter['end']['day'];

			$conditions = array();
			$conditions['AND']['Lmail.created BETWEEN ? AND ?'] = array($start, $end);

			if ($filter['status'] != 'ALL'){
				$conditions['AND']['Lmail.status'] = $filter['status'];
			}

			if ($search['type'] != 'NONE' && !empty($search['key'])) {
				$conditions['AND']['Lmail.'.$search['type'].' LIKE '] = '%%'.$search['key'].'%%';
			}

			$this->set('lmails', $this->paginate($conditions));
		}
	}
	
	public function admin_add($id = null) {
		$this->loadModel('User');

		if (empty($this->data)) {
			$default = array('ALL' => 'ALL');
			$this->set('groups', $default + $this->User->Group->find('list'));
		}
		else {
			$filter = $this->data['Filter'];
			$search = $this->data['Search'];

			$start = $filter['start']['year'].$filter['start']['month'].$filter['start']['day'];
			$end = $filter['end']['year'].$filter['end']['month'].$filter['end']['day'];

			$conditions = array();
			$conditions['AND']['User.created BETWEEN ? AND ?'] = array($start, $end);

			if ($filter['status'] != 'ALL'){
				$conditions['AND']['User.status'] = $filter['status'];
			}

			if ($search['type'] != 'NONE' && !empty($search['key'])) {
				$keys = trim($search['key']);
				$keys = explode(',', $keys);
				$or = array();
				$col = 'User.'.$search['type'].' LIKE ';
				foreach ($keys as $key) {
					$or[$col] = '%%'.$key.'%%';
					$col .= '  ';
				}

				$conditions['AND']['OR'] = $or;
			}

			// No shadow users
			$conditions['AND']['User.referrer'] = ">100";

			// 所有上海地区
			if (isset($filter['shanghai']) && $filter['shanghai'] == 1) {
				$this->User->contain(array('Profile' => array('fields' => array('id', 'gender', 'province_id', 'city_id'))));
				$conditions['AND']['Profile.province_id'] = 3;
				$users = $this->User->find('all', array('fields' => array('id', 'email'), 'conditions' => $conditions));
			}
			else {
				$this->User->recursive = -1;
				$users = $this->User->find('all', array('fields' => array('id', 'email'), 'conditions' => $conditions));
			}
			// Process 200 mails in each batch
			$now = date('Y-m-d H:m:s');
			$rpb = 200; // record per batch
			$batches = ceil(count($users) / $rpb);

			App::import('Sanitize');
			$i = 0;
			for ($c = 1; $c <= $batches; ++$c) {
				$user_ids = array();
				for ($j = $i; $j < $rpb * $c && $j < count($users); ++$j) {
					++$i;
					$user_ids[] = $users[$j]['User']['id'];
				}

				$sql = sprintf("call generateEmails('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
					$this->data['Lmail']['batch_id'], 
					Sanitize::escape($this->data['Lmail']['from']), 
					implode(',', $user_ids), 
					$this->data['Lmail']['bcc'], 

					$this->data['Lmail']['subject'], 
					Sanitize::escape($this->data['Lmail']['content_html']), 
					$this->data['Lmail']['content_text'], 
					$this->data['Lmail']['send_as'], 

					$this->data['Lmail']['status'], 
					$now
				);

				$this->Lmail->query($sql);
			}

			$this->redirect(array('action'=>'confirm', $this->data['Lmail']['batch_id']));
		}
	}

	public function admin_eadd() {
		if (empty($this->data)) {
			return ;
		}
		else {
			$filter = $this->data['Filter'];
			$search = $this->data['Search'];

			$start = $filter['start']['year'].$filter['start']['month'].$filter['start']['day'];
			$end = $filter['end']['year'].$filter['end']['month'].$filter['end']['day'];

			$conditions = array();
			$conditions['AND']['Enterprise.created BETWEEN ? AND ?'] = array($start, $end);

			if ($search['type'] != 'NONE' && !empty($search['key'])) {
				$keys = trim($search['key']);
				$keys = explode(',', $keys);
				$or = array();
				$col = 'Enterprise.'.$search['type'].' LIKE ';
				foreach ($keys as $key) {
					$or[$col] = '%%'.$key.'%%';
					$col .= '  ';
				}

				$conditions['AND']['OR'] = $or;
			}

			$conditions['AND']['Enterprise.status'] = 'ACTIVATED';

			App::import('Sanitize');
			$this->loadModel('Enterprise');
			$this->Enterprise->recursive = -1;
			$enterprises = $this->Enterprise->find('all', array('fields' => array('id', 'name', 'contact', 'email'), 
				'conditions' => $conditions));
			foreach ($enterprises as $enterprise) {
				if (strlen($enterprise['Enterprise']['email']) > 5) {
					$eid = $enterprise['Enterprise']['id'];
					$sid = md5($eid.Configure::read('Security.salt').$this->Auth->password($enterprise['Enterprise']['email']));

					$subject = str_ireplace('{name}', $enterprise['Enterprise']['name'], $this->data['Lmail']['subject']);
					$subject = str_ireplace('{contact}', $enterprise['Enterprise']['contact'], $subject);

					$link = URL_BASE."/stat/reportWinners/eid:$eid/sid:$sid";
					$replace = "<a href='$link' target='_blank'>$link</a>";

					$content = str_ireplace('{report_winners_link}', $replace, $this->data['Lmail']['content_html']);
					$content = str_ireplace('{name}', $enterprise['Enterprise']['name'], $content);
					$content = str_ireplace('{contact}', $enterprise['Enterprise']['contact'], $content);

					$sql = sprintf("
						INSERT INTO `lmails`(
							`batch_id`, `from`, `to`, `bcc`, `subject`, `content_html`, `content_text`, 
							`send_as`, `status`, `created`)
						VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",
						$this->data['Lmail']['batch_id'], 
						$this->data['Lmail']['from'], 
						$enterprise['Enterprise']['email'], 
						$this->data['Lmail']['bcc'], 
						$subject, 
						Sanitize::escape($content), 
						$this->data['Lmail']['content_text'], 

						$this->data['Lmail']['send_as'], 
						$this->data['Lmail']['status'], 
						date('Y-m-d H:m:s')
					);

					$this->Lmail->query($sql);
				}
			}

			$this->redirect(array('action'=>'confirm', $this->data['Lmail']['batch_id'], 'Enterprise'));
		}
	}

	public function admin_confirm($batchId = null, $scope = 'User') {
		if (substr($batchId, 0, 2) == 'E-') {
			$scope = 'Enterprise';
		}

		if (empty($this->data)){
			$lmails = $this->paginate(array('batch_id' => $batchId, 'status' => array('PENDING', 'CONFIRMED')));
		}
		else {
			$filter = $this->data['Filter'];
			$search = $this->data['Search'];

			$start = $filter['start']['year'].$filter['start']['month'].$filter['start']['day'];
			$end = $filter['end']['year'].$filter['end']['month'].$filter['end']['day'];

			$conditions = array();
			$conditions['AND']['batch_id'] = $batchId;
			$conditions['AND']['status'] = array('PENDING', 'CONFIRMED');

			$conditions['AND']['Lmail.created BETWEEN ? AND ?'] = array($start, $end);

			if ($filter['status'] != 'ALL'){
				$conditions['AND']['Lmail.status'] = $filter['status'];
			}

			if ($search['type'] != 'NONE' && !empty($search['key'])) {
				$keys = trim($search['key']);
				$keys = explode(',', $keys);
				$or = array();
				$col = 'Lmail.'.$search['type'].' LIKE ';
				foreach ($keys as $key) {
					$or[$col] = '%%'.$key.'%%';
					$col .= '  ';
				}

				$conditions['AND']['OR'] = $or;
			}

			$lmails = $this->paginate($conditions);
		}

		$emails = array();
		foreach ($lmails as $lmail) {
			$emails[] = $lmail['Lmail']['to'];
		}

		if ($scope == 'User') {
			$this->loadModel('User');
			$this->User->recursive = -1;
			$users = $this->User->find('all', array('conditions' => array('email' => $emails)
			));
		}
		else {
			$this->loadModel('Enterprise');
			$this->Enterprise->recursive = -1;
			$users = $this->Enterprise->find('all', array('conditions' => array('email' => $emails)
			));
		}

		foreach ($lmails as &$lmail) {
			foreach ($users as $user) {
				$u = ($scope == 'User') ? $user['User'] : $user['Enterprise'];
				if ($lmail['Lmail']['to'] == $u['email']) {
					$lmail['User'] = $u;
				}
			}
		}

		$this->set('lmails', $lmails);
		$this->set('scope', $scope);
	}

	public function admin_preview($id = null) {
		$this->set('lmail', $this->Lmail->read(null, $id));
	}

	public function admin_edit($id = null) {

	}

	public function admin_view($id = null) {
		$this->set('lmail', $this->Lmail->read(null, $id));
	}

	public function admin_del($id = null) {
		$this->Lmail->delete($id, false);

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_ajaxDel() {
		if ($this->RequestHandler->isAjax()){
			$this->Lmail->query("DELETE FROM `lmails`"
				." WHERE `id` IN ({$this->params['form']['mailIds']})");
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_delBatch($batchId = null) {
		if ($this->RequestHandler->isAjax() && $batchId){
			$this->Lmail->query("DELETE FROM `lmails` WHERE `batch_id`='$batchId'");
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_ajaxConfirm() {
		if ($this->RequestHandler->isAjax()){
			$this->Lmail->query("UPDATE `lmails` SET `status`='CONFIRMED'"
				." WHERE `id` IN ({$this->params['form']['mailIds']})");
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_confirmBatch($batchId = null) {
		if ($this->RequestHandler->isAjax() && $batchId){
			$this->Lmail->query("UPDATE `lmails` SET `status`='CONFIRMED' WHERE `batch_id`='$batchId'");
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function viewMandomTussand($userId = null) {
		$this->loadModel('User');
		$user = $this->User->read(null, $userId);

		$this -> loadModel('UserDest');
		$this->recursive = -1;
		$dest = $this->UserDest->find('first', array('conditions' => array('user_id' => $userId)));
		$user['User']['name'] = $dest['UserDest']['consignee'];

		$this->set('user', $user);
		$this->set('t', (isset($this->params['url']['t']) ? $this->params['url']['t'] : 0));
		$this->set('s', (isset($this->params['url']['s']) ? $this->params['url']['s'] : 0));
	}

	public function printMandomTussand($userId = null) {
		$this->loadModel('User');
		$user = $this->User->read(null, $userId);

		$this -> loadModel('UserDest');
		$this->recursive = -1;
		$dest = $this->UserDest->find('first', array('conditions' => array('user_id' => $userId)));
		$user['User']['name'] = $dest['UserDest']['consignee'];

		$this->set('user', $user);
		$this->set('t', (isset($this->params['url']['t']) ? $this->params['url']['t'] : 0));
		$this->set('s', (isset($this->params['url']['s']) ? $this->params['url']['s'] : 0));
	}

	public function sendMandomTussandTest() {
		loadEmailSettings('test', $this->Email);

		$this->Email->template = '__mandam_tussands__message';
		$this->Email->bcc = array('peregrinator@msn.cn', 
			'vincent@logoloto.com', 
			'xiaosjw@163.com', 
			'263206207@qq.com'
		);

	    $this->Email->send();

	    if ($this->Email->smtpError) {
	    	echo 'Failed, check log for more';
			$this->log('Failed to send email\\n\\tDetailed information:['.$this->Email->smtpError.']', LOG_ALERT);
	    }
	    else {
	    	echo 'Test finished, check admin email for result';
	    }

	    die();
	}

	public function subscribe() {
		// TODO:
	}

	public function unsubscribe() {
		// TODO:
	}
}
?>
