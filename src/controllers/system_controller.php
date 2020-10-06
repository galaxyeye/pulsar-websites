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
 * @copyright     Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 */
class SystemController extends AppController {
	
	var $uses = [];
	public $components = array (
			'Email' 
	);
	public function beforeFilter() {
		parent::beforeFilter ();
        $this->Auth->allowedActions = array('*');
	}

	public function admin_listCreatedUsers() {
		$this->loadModel ( 'User' );
		
		$newUsers = $this->paginate ( 'User', array (
				'status' => 'CREATED' 
		) );
		
		$this->set ( 'newUsers', $newUsers );
	}
	public function editor() {
	}
	public function phpinfo() {
		echo phpinfo ();
		
		Configure::Write ( 'debug', 0 );
		$this->autoRender = false;
		die ();
	}
	public function help() {
	}
}
?>
