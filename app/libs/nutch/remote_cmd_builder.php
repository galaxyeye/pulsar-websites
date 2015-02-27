<?php 

App::import('Lib', array('nutch/job_config'));
App::import('Lib', array('nutch/remote_command'));

class RemoteCmdBuilder {
	public static $JobType = array (
			"INJECT" => "INJECT",
			"GENERATE" => "GENERATE",
			"FETCH" => "FETCH",
			"PARSE" => "PARSE",
			"UPDATEDB" => "UPDATEDB",
			"INDEX" => "INDEX",
			"READDB" => "READDB",
			"EXTRACT" => "EXTRACT",
			"CLASS" => "CLASS"
	);

	public static $State = array (
			"IDLE",
			"RUNNING",
			"FINISHED",
			"FAILED",
			"KILLED",
			"STOPPING",
			"KILLING",
			"ANY"
	);

	private $crawl;

	private $remoteCommands = array();

	public function __construct($crawl) {
		assert(isset($crawl['Crawl']));

		$this->crawl = $crawl;
	}

	public function buildNutchSeedList() {
		$crawl = $this->crawl;

		// nutch seedList message
		$nutchSeeds = array();
		for ($i = 0; $i < count($crawl['Seed']); ++$i) {
			$seed = $crawl['Seed'][$i];
			array_push($nutchSeeds, array('id' => $seed['id'], 'url' => $seed['url']));
		}

		$nutchSeedList = array(
				'id' => $crawl['Crawl']['id'],
				'name' => $crawl['Crawl']['name'],
				'seedUrls' => $nutchSeeds
		);

		return $nutchSeedList;
	}

	public function buildNutchConfig() {
		$crawl = $this->crawl;

		if (empty($crawl['CrawlFilter'])) {
			return new NutchConfig();
		}

		$urlPatterns = array();
		foreach ($crawl['CrawlFilter'] as $crawlFilter) {
			array_push($urlPatterns, $crawlFilter['url_patterns']);
		}
		$urlPatterns = implode(",", $urlPatterns);

		$configId = $crawl['Crawl']['user_id'].'-'.$crawl['Crawl']['id'];
		$paras = array(URLFILTER_REGEX_RULES => $urlPatterns);
		$nutchConfig = new NutchConfig($configId, $paras);

		return $nutchConfig;
	}

	/**
	 * For test only
	 * */
	public function createCommands() {
		$crawl = $this->crawl['Crawl'];
	
		array_push($this->remoteCommands, $this->createInjectCommand());
		for ($i = 0; $i < $crawl['rounds']; $i++) {
			$this->createBatchCommands();
		}
	
		return $this->remoteCommands;
	}
	
	/**
	 * For test only
	 * */
	public function createBatchCommands() {
		$this->batchId = uniqid().'-'.time();
	
		array_push($this->remoteCommands, $this->createGenerateCommand());
		array_push($this->remoteCommands, $this->createFetchCommand());
		array_push($this->remoteCommands, $this->createParseCommand());
		array_push($this->remoteCommands, $this->createUpdateDbCommand());
		array_push($this->remoteCommands, $this->createIndexCommand());
	}

	// $crawlId, $type, $confId, $jobClassName
	public function createInjectCommand() {
		$crawl = $this->crawl['Crawl'];

		$jobConfig = new JobConfig($crawl['crawlId'], self::$JobType['INJECT'], $crawl['configId']);
		$jobConfig->setArgument("seedDir", $crawl['seedDirectory']);

		return new RemoteCommand($jobConfig);
	}

	public function createGenerateCommand() {
		$crawl = $this->crawl['Crawl'];

		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['GENERATE'], $crawl['batchId'], $crawl['configId']);
	}

	public function createFetchCommand() {
		$crawl = $this->crawl['Crawl'];

		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['FETCH'], $crawl['batchId'], $crawl['configId']);
	}

	public function createParseCommand() {
		$crawl = $this->crawl['Crawl'];
		
		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['PARSE'], $crawl['batchId'], $crawl['configId']);
	}

	public function createUpdateDbCommand() {
		$crawl = $this->crawl['Crawl'];
		
		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['UPDATEDB'],  $crawl['batchId'], $crawl['configId']);
	}

	public function createIndexCommand() {
		$crawl = $this->crawl['Crawl'];

		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['INDEX'], $crawl['batchId'], $crawl['configId']);
	}

	public function createExtractCommand() {
		$crawl = $this->crawl['Crawl'];

		return $this->createCommand(
				$crawl['crawlId'], self::$JobType['EXTRACT'], $crawl['batchId'], $crawl['configId']);
	}

	private function createCommand($crawlId, $jobType, $batchId, $configId) {
		$jobConfig = new JobConfig($crawlId, $jobType, $configId);
		if (!empty($batchId)) {
			$jobConfig->setArgument("batch", $batchId);
		}
		return new RemoteCommand($jobConfig);
	}
}
