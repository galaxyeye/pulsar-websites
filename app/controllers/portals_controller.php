<?php 
class PortalsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
	    $this->Auth->allow('index');
	}

	public function index() {
	}

	public function admin_index() {
	}
}
?>
