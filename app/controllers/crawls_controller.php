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
//     	pr($this->data);
//     	die();

    	$success = true;
      $message = "";

      // basic validation
    	$notEmptyRequirement = array(
    			$this->data['Crawl']['name'],
    			$this->data['Seed'][0]['url'],
    			$this->data['CrawlFilter'][0]['index_url_patterns'],
    			$this->data['CrawlFilter'][0]['item_url_patterns'],
    			$this->data['CrawlFilter'][0]['keywords'],
    			$this->data['CrawlFilter'][0]['bad_words'],
    			$this->data['PageEntity'][0]['name']
    	);

    	foreach ($notEmptyRequirement as $field) {
    		if (empty($field)) {
    			$success = false;
	        $message .= 'The crawl could not be saved, please check if any required field is empty.';
  	      $this->Session->setFlash(__($message, true));
  	      return;
    		}
    	}

    	$itemUrlPatterns = false;
      $this->data['Crawl']['status'] = 'CREATED';
      $this->data['Crawl']['rounds'] = 100;
      $this->data['Crawl']['limit'] = 20000;
      $this->data['Crawl']['user_id'] = $this->currentUser['id'];

      $crawlId = 0;
      $this->Crawl->create();
      if ($success && !$this->Crawl->save($this->data['Crawl'])) {
        $success = false;
        $message .= 'The crawl can not be saved.';
      }
      else {
      	$crawlId = $this->Crawl->id;

        $message .= "The crawl has been saved as #$crawlId.<br />";
      }

      // Save relative models
      unset($this->data['Crawl']);
      $this->Crawl->recursive = -1;
      $crawl = $this->Crawl->read(null, $crawlId);

      /***************************************************
       * create the default seed
       ***************************************************/
      if (!empty($this->data['Seed'])) {
      	$this->data['Seed'][0]['crawl_id'] = $crawl['Crawl']['id'];
      	$seedId = 0;
      	$this->Crawl->Seed->create();
      	if ($success && !$this->Crawl->Seed->saveAll($this->data['Seed'])) {
      		$success = false;
      		$message .= 'The seed can not be saved.';
      	}
      	else {
      		$seedId = $this->Crawl->Seed->id;

      		$message .= "The seed has been saved as #$seedId.<br />";
      	}
      }

      /***************************************************
       * create the default crawl filter
       ***************************************************/
      if (!empty($this->data['CrawlFilter'])) {
      	$this->data['CrawlFilter'][0]['crawl_id'] = $crawl['Crawl']['id'];

      	$itemUrlPatterns = $this->data['CrawlFilter'][0]['item_url_patterns'];
      	if (empty($itemUrlPatterns)) {
      		$success = false;
      	}
      	$crawlFilterId = 0;
      	$this->Crawl->CrawlFilter->create();
      	if ($success && !$this->Crawl->CrawlFilter->saveAll($this->data['CrawlFilter'])) {
      		$success = false;
      		$message .= 'The crawl filter can not be saved.';
      	}
      	else {
      		$crawlFilterId = $this->Crawl->CrawlFilter->id;

      		$message .= "The crawl filter has been saved as #$crawlFilterId.";
      	}
      }

      /***************************************************
       * create the default extraction
       ***************************************************/
      $this->data['Extraction'] = array(
      		'name' => $crawl['Crawl']['name'],
      		'status' => 'CREATED',
      		'user_id' => $this->currentUser['id'],
      		'crawl_id' => $crawl['Crawl']['id']
      );
      $extractionId = 0;
      if (!empty($this-> data['Extraction'])) {
      	$this->Crawl->Extraction->create();
      	if ($success && !$this->Crawl->Extraction->save($this->data['Extraction'])) {
      		$success = false;
      		$message .= 'The extraction can not be saved.';
      	}
      	else {
      		$extractionId = $this->Crawl->Extraction->id;

      		$message .= "The extraction has been saved as #$extractionId.<br />";
      	}
      }

      /***************************************************
       * create the default page entity
       ***************************************************/
      if ($extractionId != 0 && !empty($this->data['PageEntity'])) {
	      	$name = $this->data['PageEntity'][0]['name'];
      		$this->data['Extraction']['PageEntity'][0] = array(
      			'name' => $name,
      			'url_pattern' => $itemUrlPatterns,
      			'css_path' => ':root',
      			'extraction_id' => $extractionId,
      			'user_id' => $this->currentUser['id'],
      			'crawl_id' => $crawl['Crawl']['id']
	      	);

      		$this->loadModel('PageEntity');
      		$pageEntityId = 0;
      		$this->PageEntity->create();
      		if ($success && !$this->PageEntity->saveAll($this->data['Extraction']['PageEntity'])) {
      			$success = false;
      			$message .= 'The root page entity can not be saved.';
      		}
      		else {
      			$pageEntityId = $this->PageEntity->id;

      			$message .= "The root page entity has been saved as #$pageEntityId.<br />";
      		}
      }

      if (!$success) {
        $message .= 'The crawl could not be saved. Please, try again.';

        $this->Session->setFlash(__($message, true));
        // $this->redirect(array('action' => 'index'));
      }

      $this->Session->setFlash(__($message, true));
      // $this->redirect(array('action' => 'index'));
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
  		$this->Session->setFlash(__('You must specify a crawl id', true));
  		$this->redirect(array('action' => 'index'));
  	}

  	if (!empty($this->data)) {
  		if(!$this->checkTenantPrivilege($this->data['Crawl']['id'])) {
        $this->Session->setFlash(__('Privilege denied', true));
    		$this->redirect(array('action' => 'index'));
  		}

  		$id = $this->data['Crawl']['id'];
			$this->Crawl->contain(array(
					'Seed' => array('fields' => array('id', 'url')),
					'CrawlFilter' => array('fields' => array('id', 'url_patterns'))
			));
  		$crawl = $this->Crawl->read(null, $id);

  		if ($crawl['Crawl']['job_type'] !== 'NONE') {
  			$this->log("The crawl is already in progress!");

	  		$this->Session->setFlash(__('The crawl is already in progress!', true));
	  		$this->redirect(array('action' => 'view', $id));
  		}

  		// create nutch config
  		$configId = $this->JobManager->createNutchConfig($crawl);
  		if (empty($configId)) {
  			$this->redirect2View($id, __("Failed to create nutch config for $id", true));
  		}
  		$crawl['Crawl']['configId'] = $configId;

  		// create seed
  		$seedDirectory = $this->JobManager->createSeed($crawl);
  		if (empty($seedDirectory)) {
  			$this->redirect2View($id, __("Failed to create seed for $id", true));
  		}
  		$crawl['Crawl']['seedDirectory'] = $seedDirectory;

  		// inject
  		$jobId = $this->JobManager->inject($crawl);
  		if ($jobId === false) {
  			$this->redirect2View($id, __("Failed to inject for crawl #$id", true), 'error');
  		}

  		$this->redirect2View($id, __('Start crawl successfully', true));
  	}

	  $this->redirect(array('action' => 'view', $id));
  }

  function ajax_getStatus() {
  	$client = new NutchClient();
  	$output = $client->getNutchStatus();

  	$this->autoRender = false;

  	echo $output;
  }

  function ajax_getJobInfo($crawlId, $realTime = false) {
  	if(!$this->checkTenantPrivilege($crawlId)) {
  		return "401";
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

  	$this->autoRender = false;
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

    $crawl = array('Crawl' => array(
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

  function admin_testNutchMessage($id = null) {
  	$crawl = $this->Crawl->read(null, $id);

  	$cmdBuilder = new RemoteCmdBuilder($crawl);

  	$nutchConfig = $cmdBuilder->buildNutchConfig();
  	pr($nutchConfig->__toString());

  	$nutchSeedList = $cmdBuilder->buildNutchSeedList();
  	pr(json_encode($nutchSeedList));

  	$commands = $cmdBuilder->createCommands($crawl);
  	foreach ($commands as $command) {
  		pr($command->getJobConfig()->__toString());
		}

  	$this->autoRender = false;
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

}
