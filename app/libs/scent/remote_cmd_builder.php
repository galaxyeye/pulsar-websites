<?php 
namespace Scent;

\App::import('Lib', array('scent/job_config', 'scent/scent_config', 'scent/remote_command'));

class JobType {
  const __default = self::CLASS;
  const SEGMENT = 'SEGMENT';
  const AUTOEXTRACT = 'AUTOEXTRACT';
  const RULEDEXTRACT = 'RULEDEXTRACT';
  const BUILD = 'BUILD';
  const CLAZZ = 'CLASS';
}

class JobState {
  const __default = self::IDLE;
  const IDLE = 'IDLE';
  const RUNNING = 'RUNNING';
  const FINISHED = 'FINISHED';
  const FAILED = 'FAILED';
  const KILLED = 'KILLED';
  const STOPPING = 'STOPPING';
  const KILLING = 'KILLING';
  const ANY = 'ANY';
}

class RemoteCmdBuilder {

  private $p;

  public function __construct($p) {
    assert(isset($p['PageEntity']));
    assert(isset($p['PageEntityField']));

    if(!isset($p['PageEntity']['crawlId'])) {
      $p['PageEntity']['crawlId'] = '';
    }

    if(!isset($p['PageEntity']['batchId'])) {
      $p['PageEntity']['batchId'] = $p['PageEntity']['user_id'].
        '-'.$p['PageEntity']['id'].date('Ymd-His');
    }

    if(!isset($p['PageEntity']['configId'])) {
      $p['PageEntity']['configId'] = 'default';
    }

    $this->pageEntity = $p;
  }

  public function buildScentConfig() {
    $p = $this->pageEntity['PageEntity'];

    $urlFilter = \Nutch\normalizeUrlFilter($p['url_filter']);
    $urlFilter .= '-.';
    $textFilter = $p['text_filter'];

    $params = array(
        URLFILTER_REGEX_RULES => $urlFilter,
        CONTENTFILTER_CONTENT_RULES => $textFilter
    );
    $configId = $p['user_id'].'-'.$p['id'].'-'.date("md-his");
    $scentConfig = new ScentConfig($configId, $params);

    return $scentConfig;
  }

  /**
   * For test only
   * */
  public function createCommands() {
    $remoteCommands = array();

    array_push($remoteCommands, $this->createSegmentCommand());
    array_push($remoteCommands, $this->createExtractCommand());
    array_push($remoteCommands, $this->createRuledExtractCommand());
    array_push($remoteCommands, $this->createSegmentCommand());

    return $remoteCommands;
  }

  public function createSegmentCommand() {
    $p = $this->pageEntity['PageEntity'];

    // set arguments

    return $this->createCommand(
        $p['crawlId'], JobType::SEGMENT, $p['batchId'], $p['configId']);
  }

  public function createAutoExtractCommand() {
    $p = $this->pageEntity['PageEntity'];

    return $this->createCommand(
        $p['crawlId'], JobType::EXTRACT, $p['batchId'], $p['configId']);
  }

  public function createRuledExtractCommand() {
    $p = $this->pageEntity['PageEntity'];
    $urlFilter = \Nutch\splitUrlFilter($p['url_filter']);

    $limit = 10000;
    if (!empty($p['limit'])) $limit = $p['limit'];

    $jobConfig = new JobConfig($p['crawlId'], JobType::RULEDEXTRACT, $p['configId']);
    $jobConfig->setArgument("-regex", $urlFilter[0]);
    $jobConfig->setArgument("-limit", $limit);
    $jobConfig->setArgument("-rules", '[base64]'.base64_encode($p['extract_rules']));
    $jobConfig->setArgument("-mode", "mr");

//     pr($jobConfig->__toString());
//     die();

    return new RemoteCommand($jobConfig);
  }

  public function createBuildCommand() {
    $p = $this->pageEntity['PageEntity'];

    return $this->createCommand(
        $p['crawlId'], JobType::BUILD, $p['batchId'], $p['configId']);
  }

  private function createCommand($pId, $jobType, $batchId, $configId) {
    $jobConfig = new JobConfig($pId, $jobType, $configId);

    if (!empty($batchId)) {
      $jobConfig->setArgument("batch", $batchId);
    }

    return new RemoteCommand($jobConfig);
  }
}
