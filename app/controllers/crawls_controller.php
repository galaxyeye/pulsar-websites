<?php 

class CrawlsController extends AppController {

  public $name = 'Crawls';

  function index() {
  	$this->paginate['Crawl'] = array('limit'=> 500, 'order' => 'Crawl.id DESC');

    $this->Crawl->recursive = 0;
    $this->set('crawls', $this->paginate(array('Crawl.user_id' => $this->currentUser['id'])));
  }

  function view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid crawl', true));
      $this->redirect(array('action' => 'index'));
    }

    if(!$this->checkTenantPrivilege($id)) {
    	$this->Session->setFlash(__('Privilege denied', true));
    	$this->redirect(array('action' => 'index'));
    }

    $this->Crawl->contain(array(
    		'Seed' => array('limit' => 10),
    		'CrawlFilter',
    		'HumanAction',
    		'WebAuthorization',
    		'Extraction' => array(
    			'PageEntity' => 'PageEntityField'
    		)
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

      // add a custom metadata
//       foreach ($this->data['Seed'] as &$seed) {
//       	$seed['url'] .= "\tisSeed=true";
//       }

      // Save relative models
      foreach (array('Seed', 'CrawlFilter', 'WebAuthorization', 'HumanAction') as $relatedModel) {
      	if (!$success) break;
      	$message .= $this->_saveRelated($relatedModel, $crawl, $success);
      }

      $this->Session->setFlash(__($message, true));
      if ($success) $this->redirect(array('action' => 'view', $crawlId));
    }
  }

  function add_wes() {
    if (!empty($this->data)) {
    	if (!$this->_validateAddWes($this->data)) {
    		$message = 'The Crawl could not be saved, please check if any required field is empty.';
    		$this->Session->setFlash(__($message, true));
    		return;
    	}

    	$success = true;
    	$message = "";

    	$crawlName = "WES-".$this->data['PageEntity'][0]['name'].'-'.date('YmdHis');
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

      // add a custom metadata
//       foreach ($this->data['Seed'] as &$seed) {
//       	$seed['url'] .= "\tisSeed=true";
//       }

      // Save related models
      foreach (array('Seed', 'CrawlFilter') as $relatedModel) {
      	if (!$success) break;
      	$message .= $this->_saveRelated($relatedModel, $crawl, $success);
      }

      $this->Session->setFlash(__($message, true));
      if ($success) $this->redirect(array('action' => 'view', $crawlId));
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

  function status($id = null) {
  	if(!$this->checkTenantPrivilege($id)) {
  		$this->Session->setFlash(__('Privilege denied', true));
  		$this->redirect(array('action' => 'index'));
  	}

  	$this->set('crawl', $this->Crawl->read(null, $id));
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

  		if ($crawl['Crawl']['job_type'] !== 'NONE') {
  			$this->redirect2View($id, "Crawl #$id is already in progress!");
  		}

  		// create nutch config
  		$configId = $this->JobManager->createNutchConfig($crawl);
  		if (empty($configId)) {
  			$this->redirect2View($id, "Failed to create nutch config for #$id");
  		}
  		$crawl['Crawl']['configId'] = $configId;

  		// create seed
  		$seedDirectory = $this->JobManager->createSeed($crawl);
  		if (empty($seedDirectory)) {
  			$this->redirect2View($id, "Failed to create seed for $id");
  		}
  		$crawl['Crawl']['seedDirectory'] = $seedDirectory;

  		// inject
  		$jobId = $this->JobManager->inject($crawl);
  		if ($jobId === false) {
  			$this->redirect2View($id, "Failed to inject for crawl #$id", 'error');
  		}

  		$this->redirect2View($id, __('Start crawl successfully', true));
  	}

	  $this->redirect(array('action' => 'view', $id));
  }

  function ajax_get($id) {
  	$this->autoRender = false;

  	$this->Crawl->recursive = -1;
  	echo $this->jsonify($id);
  }

  function ajax_getStatus() {
  	$this->autoRender = false;

  	$client = new NutchClient();
  	$output = $client->getNutchStatus();

  	echo $output;
  }

  function ajax_getJobInfo($crawlId, $realTime = false) {
  	$this->autoRender = false;

  	$errno = 0;
  	if (empty($crawlId)) {
  		$errno = 404;
  	}

  	if(!$this->checkTenantPrivilege($crawlId)) {
  		$errno = 401;
  	}

  	if ($errno) {
  		echo "{errno : $errno}";
  		return;
  	}

  	$this->Crawl->recursive = -1;
  	$crawl = $this->Crawl->read(null, $crawlId);

  	if ($realTime && !empty($crawl['Crawl']['jobId'])) {
  		$client = new NutchClient();
			echo $client->getjobInfo($crawl['Crawl']['jobId']);
  	}
  	else {
  		echo $crawl['Crawl']['job_raw_msg'];
  	}
  }

  function resetCrawl($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for crawl', true));
      $this->redirect(array('action'=>'index'));
    }

    if(!$this->checkTenantPrivilege($id)) {
    	$this->Session->setFlash(__('Privilege denied', true));
    	$this->redirect(array('action' => 'index'));
    }

    $this->Crawl->recursive = -1;
    $crawl = $this->Crawl->read(null, $id);
    if (empty($crawl['Crawl']['id'])) {
    	$this->redirect(array('action' => 'index'));
    }

    $crawl = array('Crawl' => array(
    		'id' => $id,
    		'finished_rounds' => 0,
    		'batchId' => null,
    		'configId' => null,
    		'jobId' => null,
    		'job_type' => 'NONE',
    		'job_state' => 'NONE',
    		'job_msg' => '',
    		'job_raw_msg' => '',
    		'seedDirectory' => ''
    ));

    $this->Crawl->save($crawl);

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

  	$cmdBuilder = new RemoteCmdBuilder($crawl);

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
  	if (!$success || !isset($this->data[$model]) || !is_array($this->data[$model]) || empty($this->data[$model])) {
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
  
}
