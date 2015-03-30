<?php

class PrivilegeGrantorShell extends Shell {
	public $root = null;
	public $supperuser = null;
	public $manager = null;
	public $user = null;

	public $uses = array('User', 'Group');

	function startup() {
		$this->out('Start up ...');

		App::import('Core','Controller');
		App::import('Component','Acl');

		$this->Acl =& new AclComponent();
		$controller = null;
		$this->Acl->startup($controller);

		$this->Acl->Aco->query("TRUNCATE aros_acos");
		$this->out('Old privilege are deleted');

		$this->Group->recursive = -1;
		$this->root = $this->Group->findByName('root');
		$this->superuser = $this->Group->findByName('superuser');
		$this->manager = $this->Group->findByName('manager');
		$this->user = $this->Group->findByName('user');
		$this->enterprise = $this->Group->findByName('enterprise');
	}

	public function main() {
		// firstly, deny all
		$this->denyAll();

		// secondly, set public pages
		$this->allow();

		$this->grantsuperuser();

		$this->grantManager();
		
		$this->grantUser();

		$this->grantEnterprise();

		$this->grantIndividual();

		$this->out('Rules are builded');
	}

	public function denyAll(){
		$this->out('Denny all privilege');

		$this->Acl->deny($this->root, 'controllers');
		$this->Acl->deny($this->superuser, 'controllers');
		$this->Acl->deny($this->manager, 'controllers');
		$this->Acl->deny($this->user, 'controllers');
		$this->Acl->deny($this->enterprise, 'controllers');
	}

	public function allow(){
		$this->out('Grant public pages to all');
	}

	public function grantsuperuser(){
		$this->out('Grant privilege to superuser');
		// privilege for superusers
		$this->Acl->allow($this->superuser, 'controllers');
	}

	public function grantManager(){
		$this->out('Grant privilege to manager');
		// privilege for managers
		$this->Acl->allow($this->manager, 'controllers');
	}

	public function grantUser(){
		$this->out('Grant privilege to users');
		$this->Acl->allow($this->user, 'controllers');
	}

	public function grantEnterprise(){
		$this->out('Grant enterprise user');
	}

	public function grantIndividual(){
		// grant xiaosjw@163.com the root privilege
		$this->out('Grant all privilege to root@logoloto.com');
		$rootUser = $this->User->findByEmail('root@logoloto.com');
		$this->Acl->allow($rootUser, 'controllers');
	}
}
