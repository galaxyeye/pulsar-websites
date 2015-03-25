<?php 

class CrawlsController extends AppController {

  public $name = 'Crawls';

  public static $state = [
  		'CREATED' => 'CREATED',
  		'RUNNING' => 'RUNNING',
  		'PAUSED' => 'PAUSED',
  		'COMPLETED' => 'COMPLETED'
  ];

  function index() {
    $this->paginate['Crawl'] = ['limit'=> 500, 'order' => 'Crawl.id DESC'];

    $this->Crawl->recursive = 0;
    $this->set('crawls', $this->paginate(['Crawl.user_id' => $this->currentUser['id']]));
  }

  /**
   * Step : 
   * 1. seed
   * 2. add wes
   * 3. 
   * 4. 
   * 5. 
   * */
  function analysis() {
    $stepNo = 1;
    if (!empty($this->params['named']['stepNo'])) {
      $stepNo = $this->params['named']['stepNo'];
    }
    else if (!empty($this->data['Crawl']['stepNo'])) {
      $stepNo = $this->data['Crawl']['stepNo'];
    }

    if ($stepNo == 1) {
      $this->_wizardStep1();
    }
    else if ($stepNo == 2) {
      $this->_wizardStep2();
    }
    else if ($stepNo == 3) {
      $this->_wizardStep3();
    }
    else if ($stepNo == 4) {
      $this->_wizardStep4();
    }
    else if ($stepNo == 5) {
      $this->_wizardStep5();
    }
  }

  private function _wizardStep1() {
    if (empty($this->data)) {
      $stepNo = 1;
      $this->set(compact('stepNo'));
      return;
    }

    $seed = $this->data['Crawl']['url'];

    App::import('Lib', array('simple_crawler'));
    $crawler = new SimpleCrawler();
    $crawler->crawl($seed, 2);

    $outlinks = $crawler->getOutlinks();
    // $outlinks = json_encode($outlinks);

    $outlinks = groupUrls($outlinks);

    $stepNo = 2;
    $this->set(compact('stepNo', 'seed', 'outlinks'));
  }

  // New WES
  private function _wizardStep2() {
    // Nothing to do here, the client submit to addWes directly
//     $this->addWes();
  }

  // View Crawl & Start Crawl
  private function _wizardStep3() {
    if (!empty($this->data['Crawl']['id'])) {
      $this->startCrawl();

      $stepNo = 4;
      $this->set(compact('stepNo'));
    }

    if (empty($this->data['Crawl']['id'])) {
      $crawl_id = null;
      if (isset($this->params['named']['crawl_id'])) {
        $crawl_id = $this->params['named']['crawl_id'];
      }

      $this->Crawl->contain(array('Seed', 'CrawlFilter', 'PageEntity'));
      $crawl = $this->Crawl->read(null, $crawl_id);

      $stepNo = 3;
      $this->set(compact('stepNo', 'crawl'));
    }
  }

  // View Page Entity & Add Fields
  private function _wizardStep4() {
    $crawl_id = null;
    if (isset($this->params['named']['crawl_id'])) {
      $crawl_id = $this->params['named']['crawl_id'];
    }

    $this->Crawl->contain(['PageEntity' => ['PageEntityField']]);
    $crawl = $this->Crawl->read(null, $crawl_id);

    $stepNo = 4;
    $this->set(compact('stepNo', 'crawl'));
  }

  // View Page Entity & Add Fields
  private function _wizardStep5() {
    $page_entity_id = null;
    if (isset($this->params['named']['page_entity_id'])) {
      $page_entity_id = $this->params['named']['page_entity_id'];
    }

    $this->loadModel('PageEntity');
    $this->PageEntity->contain(array(
        'PageEntityField',
        'ScentJob' => array(
          'conditions' => array('ScentJob.type' => 'RULEDEXTRACT'),
          'limit' => 1,
          'order' => 'ScentJob.id DESC'
        )
    ));
    $pageEntity = $this->PageEntity->read(null, $page_entity_id);

    $stepNo = 5;
    $this->set(compact('stepNo', 'pageEntity'));
  }

  /**
   * To slow to start using Nutch to analysis
   * @deprecated
   * */
  function analysis2() {
    if (empty($this->data)) {
      return;
    }

    $url = $this->data['Crawl']['url'];
    $tld = get_tld($url);

    $nameBase = substr($tld, 0, strpos($tld, "."));
    $crawlName = "WES-ANALYSIS-$nameBase-".date('Ymd-His');
    $crawlName = preg_replace("/\s+/", "-", $crawlName);

    $data = array(
        'Crawl' => [
            'name' => $crawlName,
            'status' => 'CREATED',
            'rounds' => 3,
            'limit' => 100,
            'user_id' => $this->currentUser['id']
        ],
        'Seed' => [['url' => $url]],
        'PageEntity' => [['name' => $crawlName]],
        'CrawlFilter' => [['url_filter' => "^http://(.+)$tld/(.+)"]]
    );

    $this->data = $data;

    $success = true;
    $message = "";

    $crawl_id = 0;
    $this->Crawl->create();
    if ($success && !$this->Crawl->save($this->data['Crawl'])) {
      $success = false;
      $message .= 'The Crawl could not be saved.';
    }
    else {
      $crawl_id = $this->Crawl->id;

      $message .= "The Crawl has been saved as #$crawl_id.<br />";
    }

    // Save relative models
    $this->Crawl->recursive = -1;
    $crawl = $this->Crawl->read(null, $crawl_id);

    // add a custom metadata
    //       foreach ($this->data['Seed'] as &$seed) {
    //         $seed['url'] .= "\tisSeed=true";
    //       }

    // Save related models
    foreach (array('Seed', 'CrawlFilter') as $relatedModel) {
      if (!$success) break;
      $message .= $this->_saveRelated($relatedModel, $crawl, $success);
    }

    $this->data = array('Crawl' => array('id' => $crawl_id));
    // pr($this->data);
    $this->startCrawl();
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid crawl', true));
      $this->redirect(array('action' => 'index'));
    }

//     if(!$this->checkTenantPrivilege($id)) {
//       $this->Session->setFlash(__('Privilege denied', true));
//       $this->redirect(array('action' => 'index'));
//     }
    
    $this->Crawl->contain(array(
        'Seed' => array('limit' => 10),
        'CrawlFilter',
        'HumanAction',
        'WebAuthorization',
        'StopUrl',
        'PageEntity',
        'NutchJob' => array('limit' => 10, 'order' => 'NutchJob.id DESC')
      )
    );
    $crawl = $this->Crawl->read(null, $id);

    $this->set(compact('crawl'));
  }

  function add() {
    if (!empty($this->data)) {
      if (!$this->_validateAdd($this->data)) {
        $message = 'The Crawl could not be saved, please check if any required field is empty.';
        $this->Session->setFlash(__($message, true));
        return;
      }

      $success = true;
      $message = "";

      $this->data['Crawl']['status'] = 'CREATED';
      $this->data['Crawl']['rounds'] = 100;
      $this->data['Crawl']['limit'] = 20000;
      $this->data['Crawl']['user_id'] = $this->currentUser['id'];

      $crawlId = 0;
      $this->Crawl->create();
      if ($success && !$this->Crawl->save($this->data['Crawl'])) {
        $success = false;
        $message .= 'The Crawl could not be saved.';
      }
      else {
        $crawlId = $this->Crawl->id;

        $message .= "The Crawl has been saved as #$crawlId.<br />";
      }

      $this->Crawl->recursive = -1;
      $crawl = $this->Crawl->read(null, $crawlId);

      $this->data['CrawlFilter'] = $this->_tidyCrawlFilter($this->data['CrawlFilter']);

      // Save relative models
      foreach (array('Seed', 'CrawlFilter', 'WebAuthorization', 'HumanAction') as $relatedModel) {
        if (!$success) break;
        $message .= $this->_saveRelated($relatedModel, $crawl, $success);
      }

      $this->Session->setFlash(__($message, true));
      if ($success) $this->redirect(array('action' => 'view', $crawlId));
    }
  }

  function addWes() {
    if (empty($this->data)) {
      return;
    }

    if (!$this->_validateAddWes($this->data)) {
      $message = 'The Crawl could not be saved, please check if any required field is empty.';
      $this->Session->setFlash(__($message, true));
      return;
    }

    $success = true;
    $message = "";

    $crawlName = "crawl-".$this->data['PageEntity'][0]['name'];
    $crawlName = preg_replace("/\s+/", "-", $crawlName);

    $this->data['Crawl']['name'] = $crawlName;
    $this->data['Crawl']['status'] = 'CREATED';
    $this->data['Crawl']['rounds'] = 100;
    $this->data['Crawl']['limit'] = 20000;
    $this->data['Crawl']['user_id'] = $this->currentUser['id'];

    $crawlId = 0;
    $this->Crawl->create();
    if ($success && !$this->Crawl->save($this->data['Crawl'])) {
      $success = false;
      $message .= 'The Crawl could not be saved.';
    }
    else {
      $crawlId = $this->Crawl->id;

      $message .= "The Crawl has been saved as #$crawlId.<br />";
    }

    // Save relative models
    $this->Crawl->recursive = -1;
    $crawl = $this->Crawl->read(null, $crawlId);

    $urlFilter = $this->data['CrawlFilter'][1]['url_filter'];
    $this->data['PageEntity'][0]['url_filter'] = \Nutch\normalizeUrlFilterRegex($urlFilter);

    // Save related models
    foreach (array('Seed', 'CrawlFilter', 'PageEntity') as $relatedModel) {
      if (!$success) break;
      $message .= $this->_saveRelated($relatedModel, $crawl, $success);
    }

    $this->Session->setFlash(__($message, true));
    if ($success) {
      if (isset($this->data['Ui']['analysis'])) {
        $this->redirect(array('action' => 'analysis', 'stepNo' => '3', 'crawl_id' => $crawlId));
      }
      else {
        $this->redirect(array('action' => 'view', $crawlId));
      }
    }
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid crawl', true));
      $this->redirect(array('action' => 'index'));
    }

    if (!empty($this->data)) {
      if(!$this->checkTenantPrivilege($this->data['Crawl']['id'])) {
        $this->Session->setFlash(__('Privilege denied', true));
        $this->redirect(array('action' => 'index'));
      }

      if ($this->Crawl->save($this->data)) {
        $this->Session->setFlash(__('The crawl has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
      }
    }

    if (empty($this->data)) {
      $this->data = $this->Crawl->read(null, $id);
    }
  }

  function viewStatus($id = null) {
    if(!$this->checkTenantPrivilege($id)) {
      $this->Session->setFlash(__('Privilege denied', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->set('crawl', $this->Crawl->read(null, $id));
  }

  function ajax_get($id) {
    $this->autoRender = false;

    $this->Crawl->recursive = -1;
    echo $this->jsonify($id);
  }

  function ajax_analysis() {
    $this->autoRender = false;

    if (!isset($this->params['url']['u'])) {
        return $this->getStatus(400, 'Invalid request body.', $this->params);
    }

    $url = $this->params['url']['u'];

    App::import('Lib', array('simple_crawler'));
    $crawler = new SimpleCrawler();
    $crawler->crawl($url);

    $outlinks = $crawler->getOutlinks();
    $outlinks = json_encode($outlinks);

    echo $outlinks;

    // $this->set(compact('outlinks'));
  }

  function ajax_getStatus() {
    $this->autoRender = false;

    $client = new NutchClient();
    $output = $client->getNutchStatus();

    echo $output;
  }

  function ajax_getJobInfo($crawl_id) {
    $this->autoRender = false;

    if (empty($crawl_id)) {
      echo getResponseStatusJson(400);
      return;
    }

    if(!$this->checkTenantPrivilege($crawl_id)) {
      echo getResponseStatusJson(401);
      return;
    }

    $this->Crawl->recursive = -1;
    $this->Crawl->NutchJob->recursive = -1;
    $nutchJob = $this->Crawl->NutchJob->find('first',
        ['fields' => ['jobId'],
         'conditions' => [
         		"NutchJob.state != 'COMPLETED' AND NutchJob.state != 'FAILED_COMPLETED'",
         		'crawl_id' => $crawl_id,
         ],
         'order' => 'id DESC'
    ]);

    if (empty($nutchJob)) {
    	return null;
    }

    $client = new \Nutch\NutchClient();
    $rawMsg = $client->getJobInfo($nutchJob['NutchJob']['jobId']);

    return $rawMsg;
  }

  function startCrawl() {
  	if (empty($this->data)) {
  		$this->redirect2Index(__("You must specify a crawl id.", true));
  	}

  	if (!empty($this->data)) {
  		if(!$this->checkTenantPrivilege($this->data)) {
  			$this->redirect2Index(__("Privilege denied.", true));
  		}

  		$id = $this->data['Crawl']['id'];
  		$this->Crawl->contain(array('Seed', 'CrawlFilter', 'HumanAction', 'WebAuthorization'));
  		$crawl = $this->Crawl->read(null, $id);

  		if (empty($crawl['Crawl']) || empty($crawl['CrawlFilter'])) {
  			$this->redirect2View($id, "Incomplete Crawl or CrawlFilter.");
  		}

  		if (!empty($crawl['Crawl']['batchId'])) {
  			$this->redirect2View($id, "Crawl #$id is already in progress!");
  		}

  		// create nutch config
  		$configId = $this->NutchJobManager->createNutchConfig($crawl);
  		if ($configId['state'] != 'OK') {
  			$this->redirect2View($id, "Failed to create nutch config for #$id, message : ".$configId['state']);
  		}
  		$crawl['Crawl']['configId'] = $configId['configId'];

  		// Create seed
  		$seedDirectory = $this->NutchJobManager->createSeed($crawl);
  		if (empty($seedDirectory)) {
  			$this->redirect2View($id, "Failed to create seed for $id");
  		}
  		$crawl['Crawl']['seedDirectory'] = $seedDirectory;

  		// Inject
  		$jobId = $this->NutchJobManager->inject($crawl);
  		if (empty($jobId)) {
  			$this->redirect2View($id, "Failed to inject for crawl #$id", 'error');
  		}

  		// Update state
  		$this->_updateState($id, self::$state['RUNNING']);

  		if (isset($this->data['Ui']['analysis'])) {
  			$this->redirect(array('action' => 'analysis', 'stepNo' => '4', 'crawl_id' => $id));
  		}
  		else {
  			$this->redirect2View($id, __('Start crawl successfully', true));
  		}
  	}

  	$this->redirect(array('action' => 'view', $id));
  }

  function start($id = null) {
  	return $this->startCrawl();
  }

  function pause($id = null) {
  	if (!$id) {
  		$this->Session->setFlash(__('Invalid id for crawl', true));
  		$this->redirect(array('action'=>'index'));
  	}

  	if(!$this->checkTenantPrivilege($id)) {
  		$this->Session->setFlash(__('Privilege denied', true));
  		$this->redirect(array('action' => 'index'));
  	}

  	$this->_pauseNutchJobs($id);
  	$this->_updateState($id, self::$state['PAUSED']);

  	$this->redirect2View($id, __("Paused crawl #$id", true));
  }

  function reset($id = null) {
  	if (!$id) {
  		$this->Session->setFlash(__('Invalid id for crawl', true));
  		$this->redirect(array('action'=>'index'));
  	}

  	if(!$this->checkTenantPrivilege($id)) {
  		$this->Session->setFlash(__('Privilege denied', true));
  		$this->redirect(array('action' => 'index'));
  	}

  	$crawl = array('Crawl' => array(
  			'finished_rounds' => 0,
  			'batchId' => null,
  			'configId' => null,
  			'jobId' => null,
  			'seedDirectory' => ''
  	));

  	$this->Crawl->id = $id;
  	$this->Crawl->save($crawl);

  	$this->_pauseNutchJobs($id);

  	$this->_updateState($id, self::$state['CREATED']);

  	$this->redirect2View($id, __("Reset crawl #$id", true));
  }

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for crawl', true));
      $this->redirect(array('action'=>'index'));
    }

    if(!$this->checkTenantPrivilege($id)) {
      $this->Session->setFlash(__('Privilege denied', true));
      $this->redirect(array('action' => 'index'));
    }

//     if ($this->Crawl->delete($id)) {
//       $this->Session->setFlash(__('Crawl deleted', true));
//       $this->redirect(array('action'=>'index'));
//     }

    $this->Session->setFlash(__('Crawl was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

  function _load($id) {
    return $this->Crawl->read(null, $id);
  }

  function admin_testNutchMessage($id = null) {
    $this->autoRender = false;

    $crawl = $this->Crawl->read(null, $id);

    $cmdBuilder = new \Nutch\RemoteCmdBuilder($crawl);

    pr("-----nutch config-----");
    $nutchConfig = $cmdBuilder->buildNutchConfig();
    pr($nutchConfig->__toString());

    pr("-----nutch seed list-----");
    $nutchSeedList = $cmdBuilder->buildNutchSeedList();
    pr(json_encode($nutchSeedList));

    pr("-----nutch commands-----");
    $commands = $cmdBuilder->createCommands($crawl);
    for ($i = 0; $i < min(count($commands), 10); ++$i) {
      pr($commands[$i]->getJobConfig()->__toString());
    }
  }

  function admin_index() {
    $this->Crawl->recursive = 0;
    $this->set('crawls', $this->paginate());
  }

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid crawl', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('crawl', $this->Crawl->read(null, $id));
  }

  function admin_add() {
    if (!empty($this->data)) {
      $this->Crawl->create();
      if ($this->Crawl->save($this->data)) {
        $this->Session->setFlash(__('The crawl has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
      }
    }
    $users = $this->Crawl->User->find('list');
    $this->set(compact('users'));
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid crawl', true));
      $this->redirect(array('action' => 'index'));
    }

    if (!empty($this->data)) {
      if ($this->Crawl->save($this->data)) {
        $this->Session->setFlash(__('The crawl has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
      }
    }

    if (empty($this->data)) {
      $this->data = $this->Crawl->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for crawl', true));
      $this->redirect(array('action'=>'index'));
    }

    if ($this->Crawl->delete($id)) {
      $this->Session->setFlash(__('Crawl deleted', true));
      $this->redirect(array('action'=>'index'));
    }

    $this->Session->setFlash(__('Crawl was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

  private function _validateAdd($data) {
    if (!isset($data['Crawl']['name']) 
        || !isset($data['Seed'][0]['url']) 
        || !isset($data['CrawlFilter'][0]['url_filter'])) 
    {
      return false;
    }

    // basic validation
    $notEmptyRequirement = array(
        $data['Crawl']['name'],
        $data['Seed'][0]['url'],
        $data['CrawlFilter'][0]['url_filter']
    );

    foreach ($notEmptyRequirement as $field) {
      if (empty($field)) {
        return false;
      }
    }

    return true;
  }

  private function _validateAddWes($data) {
    if (!isset($data['PageEntity'][0]['name']) 
        || !isset($data['Seed'][0]['url']) 
        || !isset($data['CrawlFilter'][0]['url_filter'])
        || !isset($data['CrawlFilter'][1]['url_filter'])) 
    {
      return false;
    }

    // basic validation
    $notEmptyRequirement = array(
        $data['PageEntity'][0]['name'],
        $data['Seed'][0]['url'],
        $data['CrawlFilter'][0]['url_filter'],
        $data['CrawlFilter'][1]['url_filter']
    );

    foreach ($notEmptyRequirement as $field) {
      if (empty($field)) {
        return false;
      }
    }
  
    return true;
  }

  private function _saveRelated($model, $crawl, &$success) {
    if (!$success || !isset($this->data[$model]) || !is_array($this->data[$model]) 
        || empty($this->data[$model]) || empty($this->data[$model][0])) {
      $this->log("We can not save $model, please check the data again.");
      return;
    }

    // calculated requried fields
    // TODO : use beforeSave?
    foreach($this->data[$model] as &$instance) {
      $instance['crawl_id'] = $crawl['Crawl']['id'];
      $instance['user_id'] = $this->currentUser['id'];
    }

    $id = 0;
    $message = '';

    $this->Crawl->{$model}->create();
    if ($success && !$this->Crawl->{$model}->saveAll($this->data[$model])) {
      $success = false;
      $message = "$model(s) can not be saved.<br />";
    }
    else {
      $id = $this->Crawl->{$model}->id;

      $message = "Last $model have been saved as #$id.<br />";
    }

    return $message;
  }

  private function _updateState($id, $state) {
  	$this->Crawl->id = $id;
  	if(!$this->Crawl->saveField('state', $state)) {
  		$this->log("Failed to update state for crawl #$id");
  	}
  }

  private function _pauseNutchJobs($crawl_id) {
  	// TODO : issue pause command to nutch server?

  	// Once we can not find the job in Nutch Server, it's completed
  	$db =& ConnectionManager::getDataSource('default');
  	$sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
  			." WHERE `crawl_id`=$crawl_id"
  			." AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
  			." AND `state` IN ('CREATED', 'RUNNING', 'NOT_FOUND', 'FINISHED');";
    					// $this->log($sql, 'info');
  	$db->execute($sql);
  }
}
