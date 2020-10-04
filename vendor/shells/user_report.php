<?php
class UserReportShell extends Shell {
	public $uses = array('User');

	public function main()
	{
		App::import("Core", "Configure");
		$c = Configure::getInstance();
		pr($c->version());
		
		pr(App::core('cakephp'));
	}

	public function report() {
		$users = $this->User->find("all", ['conditions' => ["User.status" => 'CREATED'], 'limit' => 100]);
		
		foreach($users as $user) {
			$this->out('User name:	' .    $user['User']['name'] . "\n");
			$this->out('User pass:	' .    $user['User']['password'] . "\n");
			$this->out('----------------------------------------' .    "\n");
		}
	}
}
?>
