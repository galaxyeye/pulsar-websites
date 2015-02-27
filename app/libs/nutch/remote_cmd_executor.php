<?php 

App::import('Lib', array('nutch/nutch_client'));
App::import('Lib', array('nutch/remote_cmd_builder'));

class RemoteCmdExecutor {

	private $client;

	public function __construct() {
		$this->client = new NutchClient();
	}

	function createNutchConfig($crawl) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);
		$nutchConfig = $cmdBuilder->buildNutchConfig();

		return $this->client->createNutchConfig($nutchConfig);
	}

	public function createSeed($crawl) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);
		$nutchSeedList = $cmdBuilder->buildNutchSeedList();

		return $this->client->createSeed($nutchSeedList);
	}

	function executeRemoteJob($crawl, $jobType) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);

		if ($jobType == 'INJECT') {
			$command = $cmdBuilder->createInjectCommand();
		}
		else if ($jobType == 'GENERATE') {
			$command = $cmdBuilder->createGenerateCommand();
		}
		else if ($jobType == 'FETCH') {
			$command = $cmdBuilder->createFetchCommand();
		}
		else if ($jobType == 'PARSE') {
			$command = $cmdBuilder->createParseCommand();
		}
		else if ($jobType == 'UPDATEDB') {
			$command = $cmdBuilder->createUpdateDbCommand();
		}
		else if ($jobType == 'INDEX') {
			$command = $cmdBuilder->createIndexCommand();
		}
		else if ($jobType == 'EXTRACT') {
			$command = $cmdBuilder->createExtractCommand();
		}
		else {
			return false;
		}

		$jobId = $this->submitJob($command);

		return $jobId;
	}

	private function submitJob($remoteCommand) {
		$jobInfo = $this->client->executeJob($remoteCommand->getJobConfig());

		return $jobInfo;
	}
}
