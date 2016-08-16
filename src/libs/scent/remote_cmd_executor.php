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

  function executeRemoteJob($pageEntity, $jobType) {
    $cmdBuilder = new RemoteCmdBuilder($pageEntity);

    if ($jobType == JobType::SEGMENT) {
      $command = $cmdBuilder->createSegmentCommand();
    }
    else if ($jobType == JobType::AUTOEXTRACT) {
      $command = $cmdBuilder->createAutoExtractCommand();
    }
    else if ($jobType == JobType::RULEDEXTRACT) {
      $command = $cmdBuilder->createRuledExtractCommand();
    }
    else if ($jobType == JobType::BUILD) {
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
      $result = $this->client->executeJob($remoteCommand->getJobConfig());
      $jobId = $result['content'];
    }

    return $jobId;
  }
}
