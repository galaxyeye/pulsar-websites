<?php 

namespace Nutch;

\App::import('Lib', array('nutch/nutch_client', 'nutch/remote_cmd_builder'));

class RemoteCmdExecutor extends \Object {

	private $client;

	public function __construct() {
		$this->client = new NutchClient();
	}

	function createNutchConfig($crawl, $priority = 'minor') {
		$cmdBuilder = new RemoteCmdBuilder($crawl);
		$nutchConfig = $cmdBuilder->buildNutchConfig($priority);

		return $this->client->createNutchConfig($nutchConfig);
	}

	public function createSeed($crawl) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);
		$nutchSeedList = $cmdBuilder->buildNutchSeedList();

		return $this->client->createSeed($nutchSeedList);
	}

	function executeRemoteJob($crawl, $jobType) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);

		if ($jobType == JobType::INJECT) {
			$command = $cmdBuilder->createInjectCommand();
		}
		else if ($jobType == JobType::GENERATE) {
			$command = $cmdBuilder->createGenerateCommand();
		}
		else if ($jobType == JobType::FETCH) {
			$command = $cmdBuilder->createFetchCommand();
		}
		else if ($jobType == JobType::PARSE) {
			$command = $cmdBuilder->createParseCommand();
		}
		else if ($jobType == JobType::UPDATEDB) {
			$command = $cmdBuilder->createUpdateDbCommand();
		}
		else if ($jobType == JobType::INDEX) {
			$command = $cmdBuilder->createIndexCommand();
		}
		else if ($jobType == JobType::PARSECHECKER) {
			$command = $cmdBuilder->createParseCheckerCommand();
		}
		else if ($jobType == JobType::EXTRACT) {
			$command = $cmdBuilder->createExtractCommand();
		}
		else {
			$this->log("Unkown job type $jobType");
			return false;
		}

		return $this->submitJob($command);
	}

	public function queryByCrawlFilter($crawl, $fields = null, $limit = null) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);

		$dbFilter = $cmdBuilder->buildDbFilter(null, null, $fields, $limit);

    return $this->client->query($dbFilter);
	}

	private function submitJob($remoteCommand) {
		$jobId = false;

		if ($remoteCommand !== false) {
			$jobId = $this->client->executeJob($remoteCommand->getJobConfig());
		}

		return $jobId;
	}
}
