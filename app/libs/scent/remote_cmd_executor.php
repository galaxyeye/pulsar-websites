<?php 
namespace Scent;

\App::import('Lib', array('scent/scent_client', 'scent/remote_cmd_builder'));

class RemoteCmdExecutor extends \Object {

	private $client;

	public function __construct() {
		$this->client = new ScentClient();
	}

	function createScentConfig($pageEntity) {
		$cmdBuilder = new RemoteCmdBuilder($pageEntity);
		$scentConfig = $cmdBuilder->buildScentConfig();

		return $this->client->createScentConfig($scentConfig);
	}

	function executeRemoteJob($crawl, $jobType) {
		$cmdBuilder = new RemoteCmdBuilder($crawl);

		if ($jobType == RemoteCmdBuilder::$JobType['SEGMENT']) {
			$command = $cmdBuilder->createSegmentCommand();
		}
		else if ($jobType == RemoteCmdBuilder::$JobType['EXTRACT']) {
			$command = $cmdBuilder->createExtractCommand();
		}
		else if ($jobType == RemoteCmdBuilder::$JobType['RULEDEXTRACT']) {
			$command = $cmdBuilder->createRuledExtractCommand();
		}
		else if ($jobType == RemoteCmdBuilder::$JobType['BUILD']) {
			$command = $cmdBuilder->createBuildCommand();
		}
		else {
			$this->log("Unkown job type $jobType");
			return false;
		}

		return $this->submitJob($command);
	}

	private function submitJob($remoteCommand) {
		$jobId = false;

		if ($remoteCommand !== false) {
			$jobId = $this->client->executeJob($remoteCommand->getJobConfig());
		}

		return $jobId;
	}
}
