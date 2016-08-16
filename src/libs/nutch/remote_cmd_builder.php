<?php

namespace Nutch;

\App::import ( 'Lib', array (
		'filter_utils',
		'nutch/nutch',
		'nutch/job_config',
		'nutch/ncrawl_filter',
		'nutch/remote_command' 
) );
/**
 * Remote nutch command builder
 *
 */
class RemoteCmdBuilder extends \Object {
	/**
	 *
	 * @var \Crawl
	 *
	 */
	private $crawl;
	/**
	 *
	 * @var \ArrayAccess
	 *
	 */
	private $remoteCommands = array ();
	/**
	 *
	 * @param $crawl \Crawl        	
	 *
	 */
	public function __construct($crawl) {
		assert ( ! empty ( $crawl ['Crawl'] ), "Invalid Crawl" );
		assert ( ! empty ( $crawl ['CrawlFilter'] ), "Invalid CrawlFilter" );
		
		$this->crawl = $crawl;
	}
	/**
	 * Build nutch seed list
	 *
	 * @return array
	 *
	 */
	public function buildNutchSeedList() {
		$crawl = $this->crawl;
		
		// nutch seedList message
		$nutchSeeds = [ ];
		
		// TODO : remove duplicate urls and make sure urls are well formatted
		for($i = 0; $i < count ( $crawl ['Seed'] ); ++ $i) {
			$seed = $crawl ['Seed'] [$i];
			// seed url should add "isSeed=true" metadata
			// note : must use double quote "\"" for strings who has escaped characters
			array_push ( $nutchSeeds, array (
					'id' => $seed ['id'],
					'url' => trim($seed ['url']) . "\tisSeed=true" 
			) );
		}
		
		$nutchSeedList = [ 
				'id' => $crawl ['Crawl'] ['id'],
				'name' => $crawl ['Crawl'] ['name'],
				'seedUrls' => $nutchSeeds 
		];
		return $nutchSeedList;
	}
	
	/**
	 * Build Crawl Filters
	 * TODO : \uFFFF is used for "the largest character", but json_encode($NCrawlFilters) encode it into "\\\\uFFFF",
	 * which is not expected, try check this.
	 * Currently, we use two filters to ensure both \\uFFFF and \\\\uFFFF are used
	 * @return NCrawlFilter
	 * */
	public function buildCrawlFilters() {
		$crawl = $this->crawl;
		
		$NCrawlFilters = array (
				'crawlFilters' => [ ] 
		);
		foreach ( $crawl ['CrawlFilter'] as $f ) {
			$f ['url_filter'] = normalizeUrlFilter ( $f ['url_filter'] );
			
			$NCrawlFilter = new NCrawlFilter ( $f ['page_type'], $f ['url_filter'], $f ['text_filter'], $f ['block_filter'] );
			array_push ( $NCrawlFilters ['crawlFilters'], $NCrawlFilter->data () );
		}
		
		return $NCrawlFilters;
	}
	/**
	 * Build url filters
	 * @return string
	 * */
	public function buildUrlFilters() {
		$crawl = $this->crawl;
		
		$allUrlFilters = "";
		foreach ( $crawl ['CrawlFilter'] as $f ) {
			$f ['url_filter'] = normalizeUrlFilter ( $f ['url_filter'] );
			
			$allUrlFilters .= $f ['url_filter'];
			$allUrlFilters .= "\n";
		}
		
		$allUrlFilters .= "-.\n";
		
		return $allUrlFilters;
	}
	
	/**
	 *
	 * @param $priority string
	 *        	Nutch Server Side priority for this config
	 * @return NutchConfig
	 */
	public function buildNutchConfig($priority = "minor") {
		$crawl = $this->crawl;
		$crawl_id = $crawl ['Crawl'] ['id'];
		$configId = $crawl ['Crawl'] ['configId'];
		$crawlId = $crawl ['Crawl'] ['crawlId'];
		if (empty($crawlId)) {
			$crawlId = $crawl ['Crawl'] ['user_id'];
		}
		
		$params = [
				STORAGE_CRAWL_ID => $crawlId,
				QIWU_UI_CRAWL_ID => $crawl_id,
				URLFILTER_REGEX_RULES => $this->buildUrlFilters (),
				CRAWL_FILTER_RULES => json_encode ( $this->buildCrawlFilters () ) 
		];
		
		return new NutchConfig ( $configId, $priority, $params );
	}
	
	/**
	 *
	 * @param $startKey string
	 *        	Start key
	 * @param $endKey string
	 *        	End key
	 * @param $fields array
	 *        	Record Fields
	 * @param $limit int
	 *        	Record limit
	 * @return NutchConfig
	 */
	public function buildDbFilter($startKey = null, $endKey = null, $fields = null, $limit = null) {
		$crawl = $this->crawl;
		
		if ($limit == null) {
			$limit = 100;
		}
		
		if (count ( $crawl ['CrawlFilter'] ) == 1) {
			$regex = normalizeUrlFilter ( $crawl ['CrawlFilter'] [0] ['url_filter'] );
			$startKey = regex2startKey ( $regex );
		}
		
		$allUrlFilters = "";
		foreach ( $crawl ['CrawlFilter'] as $f ) {
			$f ['url_filter'] = normalizeUrlFilter ( $f ['url_filter'] );
			$allUrlFilters .= $f ['url_filter'];
			$allUrlFilters .= "\n";
		}
		$allUrlFilters .= "-.\n";
		
		$dbFilter = new DbFilter ( $startKey, $endKey, $allUrlFilters, $fields, $limit );
		
		return $dbFilter;
	}
	
	/**
	 * For test only
	 */
	public function createCommands() {
		$crawl = $this->crawl ['Crawl'];
		
		array_push ( $this->remoteCommands, $this->createInjectCommand () );
		for($i = 0; $i < $crawl ['rounds']; $i ++) {
			$this->createBatchCommands ();
		}
		
		return $this->remoteCommands;
	}
	
	/**
	 * For test only
	 */
	public function createBatchCommands() {
		$this->batchId = uniqid () . '-' . time ();
		
		array_push ( $this->remoteCommands, $this->createGenerateCommand () );
		array_push ( $this->remoteCommands, $this->createFetchCommand () );
		array_push ( $this->remoteCommands, $this->createParseCommand () );
		array_push ( $this->remoteCommands, $this->createUpdateDbCommand () );
		array_push ( $this->remoteCommands, $this->createIndexCommand () );
	}
	
	// $crawlId, $type, $confId, $jobClassName
	public function createInjectCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		$jobConfig = new JobConfig ( $crawl ['crawlId'], JobType::INJECT, $crawl ['configId'] );
		$jobConfig->setArgument ( "seedDir", $crawl ['seedDirectory'] );
		
		return new RemoteCommand ( $jobConfig );
	}
	public function createGenerateCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		$command = $this->createCommand ( $crawl ['crawlId'], JobType::GENERATE, $crawl ['batchId'], $crawl ['configId'] );
		
		return $command;
	}
	public function createFetchCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		$command = $this->createCommand ( $crawl ['crawlId'], JobType::FETCH, $crawl ['batchId'], $crawl ['configId'] );
		
		// $command->getJobConfig()->setArgument(RESUME_KEY, true);
		// $command->getJobConfig()->setArgument(ARG_BATCH, null);
		
		return $command;
	}
	public function createParseCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		return $this->createCommand ( $crawl ['crawlId'], JobType::PARSE, $crawl ['batchId'], $crawl ['configId'] );
	}
	public function createUpdateDbCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		return $this->createCommand ( $crawl ['crawlId'], JobType::UPDATEDB, $crawl ['batchId'], $crawl ['configId'] );
	}
	public function createIndexCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		return $this->createCommand ( $crawl ['crawlId'], JobType::INDEX, $crawl ['batchId'], $crawl ['configId'] );
	}
	public function createExtractCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		return $this->createCommand ( $crawl ['crawlId'], JobType::EXTRACT, $crawl ['batchId'], $crawl ['configId'] );
	}
	public function createParseCheckerCommand() {
		$crawl = $this->crawl ['Crawl'];
		
		$jobConfig = new JobConfig ( $crawl ['crawlId'], JobType::PARSECHECKER, $crawl ['configId'] );
		$jobConfig->setArgument ( "url", $crawl ['test_url'] );
		$jobConfig->setArgument ( "dumpText", true );
		
		return new RemoteCommand ( $jobConfig );
	}
	private function createCommand($crawlId, $jobType, $batchId, $configId) {
		$jobConfig = new JobConfig ( $crawlId, $jobType, $configId );
		if (! empty ( $batchId )) {
			$jobConfig->setArgument ( "batch", $batchId );
		}
		return new RemoteCommand ( $jobConfig );
	}
}
