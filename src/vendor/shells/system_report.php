<?php
class SystemReportShell extends Shell {

	public function main()
	{
		App::import("Core", "Configure");
		$config = Configure::getInstance();

		pr($config->version());
		pr(App::core('cakephp'));
	}
}
