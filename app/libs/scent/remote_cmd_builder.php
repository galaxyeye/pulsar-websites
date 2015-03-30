<?php 
namespace Scent;

\App::import('Lib', array('scent/job_config', 'scent/scent_config', 'scent/remote_command'));

class RemoteCmdBuilder {
  public static $JobType = array (
      "SEGMENT" => "SEGMENT",
      "AUTOEXTRACT" => "AUTOEXTRACT",
      "RULEDEXTRACT" => "RULEDEXTRACT",
      "BUILD" => "BUILD",
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
        $p['crawlId'], self::$JobType['SEGMENT'], $p['batchId'], $p['configId']);
  }

  public function createAutoExtractCommand() {
    $p = $this->pageEntity['PageEntity'];

    return $this->createCommand(
        $p['crawlId'], self::$JobType['EXTRACT'], $p['batchId'], $p['configId']);
  }

  public function createRuledExtractCommand() {
    $p = $this->pageEntity['PageEntity'];
    $urlFilter = \Nutch\splitUrlFilter($p['url_filter']);

    $limit = 10000;
    if (!empty($p['limit'])) $limit = $p['limit'];

    $jobConfig = new JobConfig($p['crawlId'], self::$JobType['RULEDEXTRACT'], $p['configId']);
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
        $p['crawlId'], self::$JobType['BUILD'], $p['batchId'], $p['configId']);
  }

  private function createCommand($pId, $jobType, $batchId, $configId) {
    $jobConfig = new JobConfig($pId, $jobType, $configId);

    if (!empty($batchId)) {
      $jobConfig->setArgument("batch", $batchId);
    }

    return new RemoteCommand($jobConfig);
  }
}
