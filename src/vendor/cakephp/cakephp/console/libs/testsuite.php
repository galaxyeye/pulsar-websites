<?php
/**
 * Test Suite Shell
 *
 * This Shell allows the running of test suites via the cakephp command line
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/view/1196/Testing>
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/view/1196/Testing CakePHP(tm) Tests
 * @package       cakephp
 * @subpackage    cakephp.cakephp.console.src
 * @since         CakePHP(tm) v 1.2.0.4433
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
class TestSuiteShell extends Shell {

/**
 * The test category, "src", "core" or the name of a plugin
 *
 * @var string
 * @access public
 */
	var $category = '';

/**
 * "group", "case" or "all"
 *
 * @var string
 * @access public
 */
	var $type = '';

/**
 * Path to the test case/group file
 *
 * @var string
 * @access public
 */
	var $file = '';

/**
 * Storage for plugins that have tests
 *
 * @var string
 * @access public
 */
	var $plugins = array();

/**
 * Convenience variable to avoid duplicated code
 *
 * @var string
 * @access public
 */
	var $isPluginTest = false;

/**
 * Stores if the user wishes to get a code coverage analysis report
 *
 * @var string
 * @access public
 */
	var $doCoverage = false;

/**
 * Initialization method installs Simpletest and loads all plugins
 *
 * @return void
 * @access public
 */
	function initialize() {
		$corePath = App::core('cakephp');
		if (isset($corePath[0])) {
			define('TEST_CAKE_CORE_INCLUDE_PATH', rtrim($corePath[0], DS) . DS);
		} else {
			define('TEST_CAKE_CORE_INCLUDE_PATH', CAKE_CORE_INCLUDE_PATH);
		}

		$this->__installSimpleTest();

		require_once CAKE . 'tests' . DS . 'lib' . DS . 'test_manager.php';
		require_once CAKE . 'tests' . DS . 'lib' . DS . 'reporter' . DS . 'cake_cli_reporter.php';

		$plugins = App::objects('plugin');
		foreach ($plugins as $p) {
			$this->plugins[] = Inflector::underscore($p);
		}
		$this->parseArgs();
		$this->getManager();
	}

/**
 * Parse the arguments given into the Shell object properties.
 *
 * @return void
 * @access public
 */
	function parseArgs() {
		if (empty($this->args)) {
			return;
		}
		$this->category = $this->args[0];

		if (!in_array($this->category, array('src', 'core'))) {
			$this->isPluginTest = true;
		}

		if (isset($this->args[1])) {
			$this->type = $this->args[1];
		}

		if (isset($this->args[2])) {
			if ($this->args[2] == 'cov') {
				$this->doCoverage = true;
			} else {
				$this->file = Inflector::underscore($this->args[2]);
			}
		}

		if (isset($this->args[3]) && $this->args[3] == 'cov') {
			$this->doCoverage = true;
		}
	}

/**
 * Gets a manager instance, and set the src/plugin properties.
 *
 * @return void
 */
	function getManager() {
		$this->Manager = new TestManager();
		$this->Manager->appTest = ($this->category === 'src');
		if ($this->isPluginTest) {
			$this->Manager->pluginTest = $this->category;
		}
	}

/**
 * Main entry point to this shell
 *
 * @return void
 * @access public
 */
	function main() {
		$this->out(__('CakePHP Test Shell', true));
		$this->hr();

		if (count($this->args) == 0) {
			$this->error(__('Sorry, you did not pass any arguments!', true));
		}

		if ($this->__canRun()) {
			$message = sprintf(__('Running %s %s %s', true), $this->category, $this->type, $this->file);
			$this->out($message);

			$exitCode = 0;
			if (!$this->__run()) {
				$exitCode = 1;
			}
			$this->_stop($exitCode);
		} else {
			$this->error(__('Sorry, the tests could not be found.', true));
		}
	}

/**
 * Help screen
 *
 * @return void
 * @access public
 */
	function help() {
		$this->out('Usage: ');
		$this->out("\tcakephp testsuite category test_type file");
		$this->out("\t\t- category - \"src\", \"core\" or name of a plugin");
		$this->out("\t\t- test_type - \"case\", \"group\" or \"all\"");
		$this->out("\t\t- test_file - file name with folder prefix and without the (test|group).php suffix");
		$this->out();
		$this->out('Examples: ');
		$this->out("\t\tcakephp testsuite src all");
		$this->out("\t\tcakephp testsuite core all");
		$this->out();
		$this->out("\t\tcakephp testsuite src case behaviors/debuggable");
		$this->out("\t\tcakephp testsuite src case models/my_model");
		$this->out("\t\tcakephp testsuite src case controllers/my_controller");
		$this->out();
		$this->out("\t\tcakephp testsuite core case file");
		$this->out("\t\tcakephp testsuite core case router");
		$this->out("\t\tcakephp testsuite core case set");
		$this->out();
		$this->out("\t\tcakephp testsuite src group mygroup");
		$this->out("\t\tcakephp testsuite core group acl");
		$this->out("\t\tcakephp testsuite core group socket");
		$this->out();
		$this->out("\t\tcakephp testsuite bugs case models/bug");
		$this->out("\t\t  // for the plugin 'bugs' and its test case 'models/bug'");
		$this->out("\t\tcakephp testsuite bugs group bug");
		$this->out("\t\t  // for the plugin bugs and its test group 'bug'");
		$this->out();
		$this->out('Code Coverage Analysis: ');
		$this->out("\n\nAppend 'cov' to any of the above in order to enable code coverage analysis");
	}

/**
 * Checks if the arguments supplied point to a valid test file and thus the shell can be run.
 *
 * @return bool true if it's a valid test file, false otherwise
 * @access private
 */
	function __canRun() {
		$isNeitherAppNorCore = !in_array($this->category, array('src', 'core'));
		$isPlugin = in_array(Inflector::underscore($this->category), $this->plugins);

		if ($isNeitherAppNorCore && !$isPlugin) {
			$message = sprintf(
				__('%s is an invalid test category (either "src", "core" or name of a plugin)', true),
				$this->category
			);
			$this->error($message);
			return false;
		}

		$folder = $this->__findFolderByCategory($this->category);
		if (!file_exists($folder)) {
			$this->err(sprintf(__('%s not found', true), $folder));
			return false;
		}

		if (!in_array($this->type, array('all', 'group', 'case'))) {
			$this->err(sprintf(__('%s is invalid. Should be case, group or all', true), $this->type));
			return false;
		}

		$fileName = $this->__getFileName($folder, $this->isPluginTest);
		if ($fileName === true || file_exists($folder . $fileName)) {
			return true;
		}

		$message = sprintf(
			__('%s %s %s is an invalid test identifier', true),
			$this->category, $this->type, $this->file
		);
		$this->err($message);
		return false;
	}
/**
 * Executes the tests depending on our settings
 *
 * @return void
 * @access private
 */
	function __run() {
		$Reporter = new CakeCliReporter('utf-8', array(
			'src' => $this->Manager->appTest,
			'plugin' => $this->Manager->pluginTest,
			'group' => ($this->type === 'group'),
			'codeCoverage' => $this->doCoverage
		));

		if ($this->type == 'all') {
			return $this->Manager->runAllTests($Reporter);
		}

		if ($this->doCoverage) {
			if (!extension_loaded('xdebug')) {
				$this->out(__('You must install Xdebug to use the CakePHP(tm) Code Coverage Analyzation. Download it from http://www.xdebug.org/docs/install', true));
				$this->_stop(0);
			}
		}

		if ($this->type == 'group') {
			$ucFirstGroup = ucfirst($this->file);
			if ($this->doCoverage) {
				require_once CAKE . 'tests' . DS . 'lib' . DS . 'code_coverage_manager.php';
				CodeCoverageManager::init($ucFirstGroup, $Reporter);
				CodeCoverageManager::start();
			}
			$result = $this->Manager->runGroupTest($ucFirstGroup, $Reporter);
			return $result;
		}

		$folder = $folder = $this->__findFolderByCategory($this->category);
		$case = $this->__getFileName($folder, $this->isPluginTest);

		if ($this->doCoverage) {
			require_once CAKE . 'tests' . DS . 'lib' . DS . 'code_coverage_manager.php';
			CodeCoverageManager::init($case, $Reporter);
			CodeCoverageManager::start();
		}
		$result = $this->Manager->runTestCase($case, $Reporter);
		return $result;
	}

/**
 * Gets the concrete filename for the inputted test name and category/type
 *
 * @param string $folder Folder name to look for files in.
 * @param boolean $isPlugin If the test case is a plugin.
 * @return mixed Either string filename or boolean false on failure. Or true if the type is 'all'
 * @access private
 */
	function __getFileName($folder, $isPlugin) {
		$ext = $this->Manager->getExtension($this->type);
		switch ($this->type) {
			case 'all':
				return true;
			case 'group':
				return $this->file . $ext; 
			case 'case':
				if ($this->category == 'src' || $isPlugin) {
					return $this->file . $ext;
				}
				$coreCase = $this->file . $ext;
				$coreLibCase = 'src' . DS . $this->file . $ext;

				if ($this->category == 'core' && file_exists($folder . DS . $coreCase)) {
					return $coreCase;
				} elseif ($this->category == 'core' && file_exists($folder . DS . $coreLibCase)) {
					return $coreLibCase;
				}
		}
		return false;
	}

/**
 * Finds the correct folder to look for tests for based on the input category and type.
 *
 * @param string $category The category of the test.  Either 'src', 'core' or a plugin name.
 * @return string the folder path
 * @access private
 */
	function __findFolderByCategory($category) {
		$folder = '';
		$paths = array(
			'core' => CAKE,
			'src' => APP_SRC
		);
		$typeDir = $this->type === 'group' ? 'groups' : 'cases';

		if (array_key_exists($category, $paths)) {
			$folder = $paths[$category] . 'tests' . DS . $typeDir . DS;
		} else {
			$pluginPath = App::pluginPath($category);
			if (is_dir($pluginPath . 'tests')) {
				$folder = $pluginPath . 'tests' . DS . $typeDir . DS;
			}
		}
		return $folder;
	}

/**
 * tries to install simpletest and exits gracefully if it is not there
 *
 * @return void
 * @access private
 */
	function __installSimpleTest() {
		if (!App::import('Vendor', 'simpletest' . DS . 'reporter')) {
			$this->err(__('Sorry, Simpletest could not be found. Download it from http://simpletest.org and install it to your vendor directory.', true));
			exit;
		}
	}
}
