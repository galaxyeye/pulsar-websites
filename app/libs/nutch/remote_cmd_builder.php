<?php 

namespace Nutch;

\App::import('Lib', array('nutch/job_config', 'nutch/outlink_filter', 'nutch/remote_command'));

class RemoteCmdBuilder extends \Object {
	public static $JobType = array (
			"INJECT" => "INJECT",
			"GENERATE" => "GENERATE",
			"FETCH" => "FETCH",
			"PARSE" => "PARSE",
			"UPDATEDB" => "UPDATEDB",
			"INDEX" => "INDEX",
			"READDB" => "READDB",
			"PARSECHECKER" => "PARSECHECKER",
			"EXTRACT" => "EXTRACT",
			"CLASS" => "CLASS"
	);

	private $crawl;

	private $remoteCommands = array();

	public function __construct($crawl) {
		assert(!empty($crawl['Crawl']), "Invalid Crawl");
		assert(!empty($crawl['CrawlFilter']), "Invalid CrawlFilter");

		$this->crawl = $crawl;
	}

	public function buildNutchSeedList() {
		$crawl = $this->crawl;

		// nutch seedList message
		$nutchSeeds = array();
		for ($i = 0; $i < count($crawl['Seed']); ++$i) {
			$seed = $crawl['Seed'][$i];
			// seed url should add "isSeed=true" metadata
			array_push($nutchSeeds, array('id' => $seed['id'], 'url' => $seed['url'].'\tisSeed=true'));
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
		$id = $crawl['Crawl']['id'];
		$configId = $crawl['Crawl']['configId'];

		$allUrlFilters = "";
		$outlinkFilters = array('outlinkFilters' => array());
		foreach ($crawl['CrawlFilter'] as $f) {
			$f['url_filter'] = \Nutch\normalizeUrlFilter($f['url_filter']);

			$outlinkFilter = new OutlinkFilter($f['page_type'], $f['url_filter'], $f['text_filter'], $f['block_filter']);
			array_push($outlinkFilters['outlinkFilters'], $outlinkFilter->data());
			$allUrlFilters .= $f['url_filter'];
			$allUrlFilters .= "\n";
		}

//   	$s = json_encode($outlinkFilters, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// 		pr($s);
// 		pr($allUrlFilters);

		// TODO : support multiple outlink filters
		$params = array(
				URLFILTER_REGEX_RULES => $allUrlFilters .'-.',
				CRAWL_OUTLINK_FILTER_RULES => json_encode($outlinkFilters['outlinkFilters'][0])
		);

		return new NutchConfig($configId, $params);
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

	public function createParseCheckerCommand() {
		$crawl = $this->crawl['Crawl'];

		$jobConfig = new JobConfig($crawl['crawlId'], self::$JobType['PARSECHECKER'], $crawl['configId']);
		$jobConfig->setArgument("url", $crawl['test_url']);
		$jobConfig->setArgument("dumpText", true);

		return new RemoteCommand($jobConfig);
	}

	private function createCommand($crawlId, $jobType, $batchId, $configId) {
		$jobConfig = new JobConfig($crawlId, $jobType, $configId);
		if (!empty($batchId)) {
			$jobConfig->setArgument("batch", $batchId);
		}
		return new RemoteCommand($jobConfig);
	}
}
