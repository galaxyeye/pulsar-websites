<?php 

App::import("Lib", ['filter_utils', "nutch/nutch", "nutch/nutch_client"]);

use Nutch\CrawlState;

class CrawlsController extends AppController
{
    public $name = 'Crawls';

    var $paginate = ['Crawl' => ['limit' => 500, 'order' => 'Crawl.id DESC']];

    public function index()
    {
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
    public function analysis()
    {
        $stepNo = 1;
        if (!empty($this->params['named']['stepNo'])) {
            $stepNo = $this->params['named']['stepNo'];
        } else if (!empty($this->data['Crawl']['stepNo'])) {
            $stepNo = $this->data['Crawl']['stepNo'];
        }

        if ($stepNo == 1) {
            $this->_wizardStep1();
        } else if ($stepNo == 2) {
            $this->_wizardStep2();
        } else if ($stepNo == 3) {
            $this->_wizardStep3();
        } else if ($stepNo == 4) {
            $this->_wizardStep4();
        } else if ($stepNo == 5) {
            $this->_wizardStep5();
        }
    }

    private function _wizardStep1()
    {
        if (empty($this->data)) {
            $stepNo = 1;
            $this->set(compact('stepNo'));
            return;
        }

        $seed = $this->data['Crawl']['url'];
        // $forceTld = $this->data['Crawl']['forceTld'];
        $forceTld = false;

        App::import('Lib', array('simple_crawler'));
        $crawler = new SimpleCrawler();
        $crawler->crawl($seed, 2, $forceTld);

        $outlinks = $crawler->getOutlinks();
        // $outlinks = json_encode($outlinks);

        $outlinks = groupUrls($outlinks);

        $stepNo = 2;
        $this->set(compact('stepNo', 'seed', 'outlinks'));
    }

    // New WES
    private function _wizardStep2()
    {
        // Nothing to do here, the client submit to addWes directly
//     $this->addWes();
    }

    // View Crawl & Start Crawl
    private function _wizardStep3()
    {
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
    private function _wizardStep4()
    {
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
    private function _wizardStep5()
    {
        $page_entity_id = null;
        if (isset($this->params['named']['page_entity_id'])) {
            $page_entity_id = $this->params['named']['page_entity_id'];
        }

        $this->loadModel('PageEntity');
        $this->PageEntity->contain(array(
            'PageEntityField',
            'ScentJob' => array(
//          'conditions' => array('ScentJob.type' => 'RULEDEXTRACT'),
                'limit' => 1,
                'order' => 'ScentJob.id DESC'
            )
        ));
        $pageEntity = $this->PageEntity->read(null, $page_entity_id);

        $stepNo = 5;
        $this->set(compact('stepNo', 'pageEntity'));
    }

    public function view($id = null)
    {
        if (!$this->checkTenantPrivilege($id)) {
            $this->Session->setFlash(__('Privilege denied', true));
            $this->redirect(array('action' => 'index'));
        }

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

    public function add()
    {
        if (!empty($this->data)) {
            if (!$this->_validateAdd($this->data)) {
                $message = 'The Crawl could not be saved, please check if any required field is empty.';
                $this->Session->setFlash(__($message, true));
                return;
            }

            $success = true;
            $message = "";

            $this->data['Crawl']['state'] = 'CREATED';
            $this->data['Crawl']['rounds'] = 50;
            $this->data['Crawl']['limit'] = 5000;
            $this->data['Crawl']['user_id'] = $this->currentUser['id'];
            if(empty($this->data['Crawl']['crawlId'])) {
            	$this->data['Crawl']['crawlId'] = STORAGE_CRAWL_ID_VALUE;
            }
            
            $crawl_id = 0;
            $this->Crawl->create();
            if ($success && !$this->Crawl->save($this->data['Crawl'])) {
                $success = false;
                $message .= 'The Crawl could not be saved.';
            } else {
                $crawl_id = $this->Crawl->id;

                $message .= "The Crawl has been saved as #$crawl_id.<br />";
            }

            $this->Crawl->recursive = -1;
            $crawl = $this->Crawl->read(null, $crawl_id);

            $this->data['CrawlFilter'] = $this->_tidyCrawlFilter($this->data['CrawlFilter']);

            // Save relative models
            foreach (array('Seed', 'CrawlFilter', 'WebAuthorization', 'HumanAction') as $relatedModel) {
                if (!$success) break;
                $message .= $this->_saveRelated($relatedModel, $crawl, $success);
            }

            $this->Session->setFlash(__($message, true));
            if ($success) $this->redirect(array('action' => 'view', $crawl_id));
        }
    }

    public function addWes()
    {
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

        $crawlName = $this->data['PageEntity'][0]['name'];
        $crawlName = preg_replace("/\\s+/i", "-", $crawlName);

        $this->data['Crawl']['name'] = $crawlName;
        $this->data['Crawl']['state'] = 'CREATED';
        $this->data['Crawl']['crawlId'] = STORAGE_CRAWL_ID_VALUE;
        $this->data['Crawl']['solrCollection'] = SOLR_COLLECTION;
        $this->data['Crawl']['rounds'] = 100;
        $this->data['Crawl']['limit'] = 5000;
        $this->data['Crawl']['user_id'] = $this->currentUser['id'];
        if(empty($this->data['Crawl']['crawlId'])) {
        	$this->data['Crawl']['crawlId'] = STORAGE_CRAWL_ID_VALUE;
        }
        
        $crawl_id = 0;
        $this->Crawl->create();
        if ($success && !$this->Crawl->save($this->data['Crawl'])) {
            $success = false;
            $message .= "The Crawl could not be saved.";
        } else {
            $crawl_id = $this->Crawl->id;

            $message .= "The Crawl has been saved as #$crawl_id.<br />";
        }

        // Save relative models
        $this->Crawl->recursive = -1;
        $crawl = $this->Crawl->read(null, $crawl_id);

        $urlFilter = $this->data['CrawlFilter'][1]['url_filter'];
        $this->data['PageEntity'][0]['url_filter'] = normalizeUrlFilterRegex($urlFilter);

        // Save related models
        foreach (array('Seed', 'CrawlFilter', 'PageEntity') as $relatedModel) {
            if (!$success) break;
            $message .= $this->_saveRelated($relatedModel, $crawl, $success);
        }

        $this->Session->setFlash(__($message, true));
        if ($success) {
            if (isset($this->data['Ui']['analysis'])) {
                $this->redirect(array('action' => 'analysis', 'stepNo' => '3', 'crawl_id' => $crawl_id));
            } else {
                $this->redirect(array('action' => 'view', $crawl_id));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid crawl', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->data)) {
            if (!$this->checkTenantPrivilege($this->data['Crawl']['id'])) {
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

    public function ajax_get($id)
    {
        $this->autoRender = false;

        $this->Crawl->recursive = -1;
        return $this->jsonify($id);
    }

    public function ajax_analysis()
    {
        $this->autoRender = false;

        if (!isset($this->params['url']['u'])) {
            return getResponseStatusJson(400);
        }

        $url = $this->params['url']['u'];

        App::import('Lib', array('simple_crawler'));
        $crawler = new SimpleCrawler();
        $crawler->crawl($url);

        $outlinks = $crawler->getOutlinks();
        $outlinks = json_encode($outlinks);

        return $outlinks;
    }

    public function ajax_getFetchCount($id = null)
    {
        $this->autoRender = false;

        if (!$this->checkTenantPrivilege($id)) {
            return getResponseStatusJson(401);
        }

        $sql = "SELECT SUM(`count`) AS count FROM `nutch_jobs`"
            . " WHERE `crawl_id`=$id "
            . " AND `type`='FETCH'";
        $count = $this->Crawl->query($sql);

        $count = $count[0][0]['count'];

        return $count;
    }

    public function ajax_getNutchConfig($id = null)
    {
        $this->autoRender = false;

        if (!$this->checkTenantPrivilege($id)) {
            return getResponseStatusJson(401);
        }

        $this->Crawl->recursive = -1;
        $crawl = $this->Crawl->read('configId', $id);
        if (empty($crawl['Crawl']['configId'])) {
            return 0;
        }

        $configId = $crawl['Crawl']['configId'];
        $client = new \Nutch\NutchClient();
        $config = $client->getNutchConfig($configId);

        return $config;
    }

    public function ajax_getJobInfo($id = null)
    {
        $this->autoRender = false;

        if (!$this->checkTenantPrivilege($id)) {
            return getResponseStatusJson(401);
        }

        $this->Crawl->NutchJob->recursive = -1;
        $nutchJob = $this->Crawl->NutchJob->find('first',
            ['fields' => ['jobId', 'type'],
                'conditions' => [
                    "NutchJob.state != 'COMPLETED' AND NutchJob.state != 'FAILED_COMPLETED'",
                    'crawl_id' => $id,
                ],
                'order' => 'id DESC'
            ]);

        if (empty($nutchJob)) {
            $count = $this->Crawl->NutchJob->find('count', ['NutchJob.crawl_id' => $id]);
            $count = $count[0][0]['count'];
            if ($count == 0) {
                return getResponseStatusJson(200, "No job yet");
            } else {
                return getResponseStatusJson(200, "All jobs are completed");
            }
        }

        $client = new \Nutch\NutchClient();

        $jobType = $nutchJob['NutchJob']['type'];
        $configId = $nutchJob['NutchJob']['jobId'];

        $rawMsg = $client->getJobInfo($nutchJob['NutchJob']['jobId']);

//     if ($jobType == 'FETCH') {
//       $status = $client->getNutchConfigPropert($configId, REPORT_FETCH_STATUS);
//       if (!empty($status)) {
//         $rawMsg = "{'FetchStatus' : $status, 'jobInfo' : $rawMsg }";
//       }
//     }

        return $rawMsg;
    }

    /**
     * Start this crawl. This will issue job requests to Nutch Server step by step,
     * until all required pages are fetched or meet other specified limitation
     *
     * 1. Create nutch config
     * 2. Create seeds
     * 3. Inject
     * 4. Start crawl cycle
     * */
    public function startCrawl()
    {
        if (empty($this->data)) {
            $this->redirect2Index(__("You must specify a crawl id.", true));
        }

        if (!empty($this->data)) {
            if (!$this->checkTenantPrivilege($this->data)) {
                $this->redirect2Index(__("Privilege denied.", true));
            }

            $id = $this->data['Crawl']['id'];
            $this->Crawl->contain(array('Seed', 'CrawlFilter', 'HumanAction', 'WebAuthorization'));
            $crawl = $this->Crawl->read(null, $id);

            if (empty($crawl['Crawl']) || empty($crawl['CrawlFilter'])) {
                $this->redirect2View($id, "Incomplete Crawl or CrawlFilter.");
            }

            if ($crawl['Crawl']['state'] != CrawlState::CREATED) {
                $this->redirect2View($id, "Crawl #$id is already in progress!");
            }

            App::import('Lib', 'nutch/job_scheduler');
            $scheduler = new \Nutch\JobScheduler($this);

            // Create the major nutch config, every UI Crawl instance should be only one
            // major Nutch Config instance, unless it's reseted
            $configId = $scheduler->createNutchConfig($crawl, null, "major");

            if ($configId['state'] != 'OK' && $configId['state'] != 'DUPLICATE') {
                $this->redirect2View($id, "Failed to create nutch config for #$id, message : " . $configId['state']);
            } else {
                $this->log("NutchConfig created, configId : " . $configId['configId'], "info");
            }

            if ($configId['state'] != 'DUPLICATE') {
                $crawl['Crawl']['configId'] = $configId['configId'];
            }

            // Create seed
            $seedDirectory = $scheduler->createSeed($crawl);
            if (empty($seedDirectory)) {
                $this->redirect2View($id, "Failed to create seed for $id");
            }
            $crawl['Crawl']['seedDirectory'] = $seedDirectory;

            // Clean old jobs
            $db =& ConnectionManager::getDataSource('default');
            $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
                . " WHERE `crawl_id`=$id"
                . " AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
                . " AND `state` IN ('CREATED', 'RUNNING', 'FINISHED', 'NOT_FOUND');";
            // $this->log($sql, 'info');
            $db->execute($sql);

            // Inject
            $jobId = $scheduler->inject($crawl);
            if (!$jobId) {
                $this->redirect2View($id, "Failed to inject for crawl #$id, please try later", 'warn');
            }

            // Update state
            $this->_updateState($id, CrawlState::RUNNING);

            if (isset($this->data['Ui']['analysis'])) {
                $this->redirect(array('action' => 'analysis', 'stepNo' => '4', 'crawl_id' => $id));
            } else {
                $this->redirect2View($id, __('Start crawl successfully', true));
            }
        }

        // $this->render("empty");
        $this->redirect(array('action' => 'view', $id));
    }

    public function start($id = null)
    {
        return $this->startCrawl();
    }

    public function pause($id = null)
    {
        if (!$this->checkTenantPrivilege($id)) {
            $this->redirect2Index(__('Privilege denied', true));
        }

        $this->Crawl->recursive = -1;
        $crawl = $this->Crawl->read(null, $id);

        if ($crawl['Crawl']['state'] != CrawlState::RUNNING) {
            $this->redirect2View($id, "Crawl #$id is not running!");
        }

        $this->_updateState($id, CrawlState::PAUSED);
        $this->_pauseNutchJobs($id);

        $this->redirect2View($id, __("Paused crawl #$id", true));
    }

    public function resume($id = null)
    {
        if (!$this->checkTenantPrivilege($id)) {
            $this->redirect2Index(__('Privilege denied', true));
        }

        $this->Crawl->contain(array('Seed', 'CrawlFilter', 'HumanAction', 'WebAuthorization'));
        $crawl = $this->Crawl->read(null, $id);

        if (empty($crawl['Crawl']) || empty($crawl['CrawlFilter'])) {
            $this->redirect2View($id, "Incomplete Crawl or CrawlFilter.");
        }

        if ($crawl['Crawl']['state'] != CrawlState::PAUSED) {
            $this->redirect2View($id, "Crawl #$id is not pused!");
        }

        App::import('Lib', 'nutch/job_scheduler');
        $scheduler = new \Nutch\JobScheduler($this);

        // Create the major nutch config, every UI Crawl instance should be only one
        // major Nutch Config instance, unless it's reseted
        $configId = $crawl['Crawl']['configId'];
        $configId = $scheduler->createNutchConfig($crawl, $configId, "major");
        if ($configId['state'] != 'OK' && $configId['state'] != 'DUPLICATE') {
            $this->redirect2View($id, "Failed to create nutch config for #$id, message : " . $configId['state']);
        } else {
            $this->log("NutchConfig created, configId : " . $configId['configId'], "info");
        }

        if ($configId['state'] != 'DUPLICATE') {
            $crawl['Crawl']['configId'] = $configId['configId'];
        }

        $this->_resumeNutchJobs($id);
        $this->_updateState($id, CrawlState::RUNNING);

        $this->redirect2View($id, __("Resumed crawl #$id", true));
    }

    public function stop($id = null)
    {
        if (!$this->checkTenantPrivilege($id)) {
            $this->redirect2Index(__('Privilege denied', true));
        }

        $this->_updateState($id, CrawlState::STOPPED);
        $this->_stopNutchJobs($id);

        $this->redirect2View($id, __("Stopped crawl #" . $id, true));
    }

    public function reset($id = null)
    {
        if (!$this->checkTenantPrivilege($id)) {
            $this->redirect2Index(__('Privilege denied', true));
        }

        $crawl = array('Crawl' => array(
            'finished_rounds' => 0,
            'jobId' => null,
            // 'fetched_pages' => 0, // NOTICE : fetched_pages is fetched from nutch server
            'configId' => null,
            'jobId' => null,
            'seedDirectory' => '',
            'state' => CrawlState::CREATED
        ));

        $this->Crawl->id = $id;
        $this->Crawl->save($crawl);

        $this->_stopNutchJobs($id);

        // $this->render("empty");
        $this->redirect2View($id, __("Reset crawl #" . $id, true));
    }

    public function maintain($id)
    {
        // Clean old jobs
        $db =& ConnectionManager::getDataSource('default');
        $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
            . " WHERE `crawl_id`=$id"
            . " AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
            . " AND `state` IN ('CREATED', 'RUNNING', 'FINISHED', 'NOT_FOUND');";
        // $this->log($sql, 'info');
        $db->execute($sql);

        $this->redirect2View($id, "Finished maintain");
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for crawl', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!$this->checkTenantPrivilege($id)) {
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

    public function admin_testCreateNutchConfig($id = null)
    {
        $this->autoRender = false;
        $this->autoLayout = false;

        $crawl = $this->Crawl->read(null, $id);
        $crawl['Crawl']['configId'] = "";

        App::import('Lib', 'nutch/job_scheduler');
        $scheduler = new Nutch\JobScheduler($this);

        $configId = $scheduler->createNutchConfig($crawl, null, 'minor');

        echo json_encode($configId);
    }

    public function admin_testCreateSeed($id, $configId)
    {
    	$this->autoRender = false;

    	$crawl = $this->Crawl->read(null, $id);
    	$crawl['Crawl']['configId'] = $configId;

    	App::import('Lib', 'nutch/job_scheduler');
    	$scheduler = new Nutch\JobScheduler($this);

    	// Create seed
    	$seedDirectory = $scheduler->createSeed($crawl, false);
    	// echo symmetric_encode($seedDirectory);
    	echo "seed directory : " . $seedDirectory;
        // echo "haha";
    }

    public function admin_testInject($id, $configId, $seedDirectory)
    {
        $crawl = $this->Crawl->read(null, $id);
        $crawl['Crawl']['configId'] = $configId;
        $crawl['Crawl']['seedDirectory'] = $seedDirectory;

        $seedDirectory = symmetric_decode($seedDirectory);

        $cmdBuilder = new Nutch\RemoteCmdBuilder($crawl);
        $result = $cmdBuilder->createInjectCommand();

        echo json_encode($result);
    }

    public function admin_testGenerate($id, $configId)
    {
        $crawl = $this->Crawl->read(null, $id);
        $crawl['Crawl']['configId'] = $configId;

        $cmdBuilder = new Nutch\RemoteCmdBuilder($crawl);
        $result = $cmdBuilder->createGenerateCommand();

        echo json_encode($result);
    }

    public function admin_testFetch($id = null)
    {
        $crawl = $this->Crawl->read(null, $id);
    }

    public function testNutchMessage($id = null)
    {
        $this->autoRender = false;

        Configure::write("debug", 1);
        
        if (!$id) {
            echo "Crawl id should be specified.";
            return;
        }

        $crawl = $this->Crawl->read(null, $id);
        $crawl['Crawl']['batchId'] = 'a.test.batch.id';

        App::import('Lib', 'nutch/job_scheduler');
        $crawl['Crawl']['solrCollection'] = SOLR_COLLECTION;
        // TODO : check this : pass by value?
        $cmdBuilder = new Nutch\RemoteCmdBuilder($crawl);

        pr("-----crawl filters-----");
        $crawlFilters = $cmdBuilder->buildCrawlFilters();
        pr($crawlFilters);
        pr(json_encode($crawlFilters, JSON_PRETTY_PRINT));

        pr("-----url filters-----");
        $urlFilters = $cmdBuilder->buildUrlFilters();
        pr($urlFilters);

        pr("-----nutch config-----");
        $nutchConfig = $cmdBuilder->buildNutchConfig();
        pr($nutchConfig->__toString());

        pr("-----nutch seed list-----");
        $nutchSeedList = $cmdBuilder->buildNutchSeedList();
        pr(json_encode($nutchSeedList));

        pr("-----nutch commands-----");
        $commands = $cmdBuilder->createCommands();
        for ($i = 0; $i < min(count($commands), 10); ++$i) {
            pr($commands[$i]->getJobConfig()->__toString());
        }
    }

    function admin_index()
    {
        $this->Crawl->recursive = 0;
        $this->set('crawls', $this->paginate());
    }

    function admin_view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid crawl', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('crawl', $this->Crawl->read(null, $id));
    }

    function admin_add()
    {
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

    function admin_edit($id = null)
    {
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

    function admin_delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for crawl', true));
            $this->redirect(array('action' => 'index'));
        }

        if ($this->Crawl->delete($id)) {
            $this->Session->setFlash(__('Crawl deleted', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->Session->setFlash(__('Crawl was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    protected function _load($id)
    {
        return $this->Crawl->read(null, $id);
    }

    private function _validateAdd($data)
    {
        if (!isset($data['Crawl']['name'])
            || !isset($data['Seed'][0]['url'])
            || !isset($data['CrawlFilter'][0]['url_filter'])
        ) {
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

    private function _validateAddWes($data)
    {
        if (!isset($data['PageEntity'][0]['name'])
            || !isset($data['Seed'][0]['url'])
            || !isset($data['CrawlFilter'][0]['url_filter'])
            || !isset($data['CrawlFilter'][1]['url_filter'])
        ) {
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

    private function _saveRelated($model, $crawl, &$success)
    {
        if (!$success || !isset($this->data[$model]) || !is_array($this->data[$model])
            || empty($this->data[$model]) || empty($this->data[$model][0])
        ) {
            $this->log("We can not save $model, please check the data again.");
            return "";
        }

        // calculated required fields
        // TODO : use beforeSave?
        foreach ($this->data[$model] as &$instance) {
            if (is_array($instance)) {
                $instance['crawl_id'] = $crawl['Crawl']['id'];
                $instance['user_id'] = $this->currentUser['id'];
            }
        }

        $this->Crawl->{$model}->create();
        if ($success && !$this->Crawl->{$model}->saveAll($this->data[$model])) {
            $success = false;
            $message = "$model(s) can not be saved.<br />";
        } else {
            $id = $this->Crawl->{$model}->id;

            $message = "Last $model have been saved as #$id.<br />";
        }

        return $message;
    }

    private function _updateState($id, $state)
    {
        $this->Crawl->id = $id;
        if (!$this->Crawl->saveField('state', $state)) {
            $this->log("Failed to update state for crawl #$id");
        }
    }

    /**
     * Pause nutch jobs on both UI side and server side.
     * 1. Mark all UI side NutchJob instance as COMPLETED
     * 2. Issue stop command to the Nutch Server, only FETCH job should be stopped
     * TODO : This may running into a race condition with job scheduling module
     * */
    private function _stopNutchJobs($crawl_id)
    {
        // Issue stop command to the Nutch Server, only FETCH job should be stopped
        $this->Crawl->NutchJob->recursive = -1;
        $nutchJob = $this->Crawl->NutchJob->find('first',
            ['fields' => ['jobId'],
                'conditions' => [
                    "NutchJob.state != 'COMPLETED' AND NutchJob.state != 'FAILED_COMPLETED'",
                    'type' => 'FETCH',
                    'crawl_id' => $crawl_id,
                ],
                'order' => 'id DESC'
            ]);

        // Mark all UI side NutchJob instance as COMPLETED
        $db =& ConnectionManager::getDataSource('default');
        $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
            . " WHERE `crawl_id`=$crawl_id"
            . " AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
            . " AND `state` NOT IN ('COMPLETED', 'FAILED_COMPLETED')";
        $db->execute($sql);

        if (!empty($nutchJob['NutchJob']['jobId'])) {
            $this->_stopNutchServerJob($nutchJob['NutchJob']['jobId']);
        }
    }

    private function _pauseNutchJobs($crawl_id)
    {
        // Mark all UI side NutchJob instance as COMPLETED
        $db =& ConnectionManager::getDataSource('default');
        $sql = "UPDATE `nutch_jobs` SET `state`='PAUSED'"
            . " WHERE `crawl_id`=$crawl_id"
            . " AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
            . " AND `state` IN ('RUNNING')"
            . " ORDER BY `id` DESC LIMIT 1"
            . ";";

        $db->execute($sql);

        // just stop the running job, we can resume it later
        // $this->_stopNutchJobs($crawl_id);
    }

    /**
     * Mark the last job as FINISHED so we can continue the crawl rounds
     * */
    private function _resumeNutchJobs($crawl_id)
    {
        // Mark all UI side NutchJob instance as COMPLETED
        $db =& ConnectionManager::getDataSource('default');
        $sql = "UPDATE `nutch_jobs` SET `state`='FINISHED'"
            . " WHERE `crawl_id`=$crawl_id"
            . " AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
            . " AND `state` IN ('PAUSED')"
            . " ORDER BY `id` DESC LIMIT 1"
            . ";";

        $db->execute($sql);
    }

    private function _stopNutchServerJob($jobId)
    {
        $client = new \Nutch\NutchClient();
        $client->stopJob($jobId);
    }
}
