<?php
class UserReportShell extends Shell {
	public $uses = array('User');

	public function main() {
		$users = $this->User->findAll("User.status = 'CREATED'");

		foreach($users as $user) {
			$this->out('User name:	' .    $user['User']['name'] . "\n");
			$this->out('User pass:	' .    $user['User']['password'] . "\n");
			$this->out('----------------------------------------' .    "\n");
		}
	}
}
?>
