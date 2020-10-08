<?php

# mysql> GRANT ALL ON official_website_0_0_1.* TO 'vincent'@'%' IDENTIFIED BY 'ViVopu__zpoooiq@vincent';

class DATABASE_CONFIG {

	public $default = array(
		'driver' => 'mysqli',
		'persistent' => true,
		'host' => 'localhost',
		'login' => 'vincent',
		'password' => 'ViVopu__zpoooiq@vincent',
		'database' => 'official_website_0_0_1',
		'encoding'=> 'utf8',
		'prefix' => ''
	);
}
