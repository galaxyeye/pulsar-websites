<?php

App::import("Lib", [
    "filter_utils",
    "nutch/nutch_client"
]);

class NutchJobsController extends AppController
{
    var $name = 'NutchJobs';
    var $paginate = [
        'NutchJob' => [
            'limit' => 300,
            'order' => 'NutchJob.id DESC'
        ]
    ];

    public function index()
    {
        $conditions = [
            'NutchJob.user_id' => $this->currentUser ['id']
        ];
        if (!empty ($this->params ['named'] ['crawl_id'])) {
            $conditions ['crawl_id'] = $this->params ['named'] ['crawl_id'];
        }

        $this->paginate ['NutchJob'] = array(
            'limit' => 300,
            'order' => 'NutchJob.id DESC'
        );
        $this->NutchJob->recursive = 0;
        $this->set('nutchJobs', $this->paginate($conditions));
    }

    public function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }

        if (!$this->checkTenantPrivilege($id)) {
            $this->Session->setFlash(__('Privilege denied', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }

        $this->set('nutchJob', $this->NutchJob->read(null, $id));
    }

    public function activeJobs($state = null)
    {
        $nutchClient = new \Nutch\NutchClient ();
        $nutchJobs = $nutchClient->getjobs($state);
        $nutchJobs = qi_json_decode($nutchJobs, true, 10, JSON_BIGINT_AS_STRING);

        if (!is_array($nutchJobs)) {
            $nutchJobs = [];
        }

        $this->set(compact('nutchJobs'));
    }

    public function plainActiveJobs($state = null)
    {
        $nutchClient = new \Nutch\NutchClient ();
        $nutchJobs = $nutchClient->getjobs($state);
        $nutchJobs = qi_json_decode($nutchJobs, true, 10, JSON_BIGINT_AS_STRING);
        if (!is_array($nutchJobs)) {
            $nutchJobs = [];
        }

        $this->set(compact('nutchJobs'));
    }

    public function activeJob($jobId)
    {
        if (!$jobId) {
            $this->Session->setFlash(__('Invalid jobId', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }

        $nutchClient = new Nutch\NutchClient ();
        $nutchJob = $nutchClient->getjobInfo($jobId);
        $nutchJob = qi_json_decode($nutchJob, true, 10, JSON_BIGINT_AS_STRING);
        $this->set(compact('nutchJob'));
    }

    public function parseChecker()
    {
        $crawl_id = 0;
        if (!empty ($this->params ['url'] ['crawl_id'])) {
            $crawl_id = $this->params ['url'] ['crawl_id'];
        }

        $target = null;
        if (!empty ($this->params ['url'] ['target'])) {
            $target = $this->params ['url'] ['target'];
        }

        if (!$this->checkTenantPrivilege($crawl_id)) {
            $this->Session->setFlash(__('Privilege denied', true));
            $this->redirect(array(
                'controller' => 'crawls'
            ));
        }

        $this->loadModel('Crawl');
        $this->Crawl->contain(array(
            'CrawlFilter',
            'Seed'
        ));
        $crawl = $this->Crawl->read(null, $crawl_id);

        if (!empty ($target)) {
            $crawl ['Crawl'] ['test_url'] = $target;
        } else {
            $crawl ['Crawl'] ['test_url'] = $crawl ['Seed'] [0] ['url'];
        }

        if (empty ($crawl ['Crawl'] ['id'])) {
            $this->Session->setFlash(__('Crawl does not exists, id #' . $crawl_id, true));
            $this->redirect(array(
                'controller' => 'crawls'
            ));
        }

        // create nutch config
        App::import('Lib', 'nutch/job_scheduler');
        $configId = $crawl_id . '-' . date('md-His');
        $scheduler = new \Nutch\JobScheduler ($this);
        $conf = $scheduler->createNutchConfig($crawl, $configId, "minor");
        if ($conf ['state'] != 'OK') {
            $message = __('Failed to create nutch config for #' . $crawl_id, true);
            $message .= "<br />" . json_encode($conf);
            $this->Session->setFlash($message);
            $this->redirect(array(
                'controller' => 'crawls',
                'action' => 'view',
                $crawl_id
            ));
        }
        $configId = $conf ['configId'];

        $crawl ['Crawl'] ['configId'] = $configId;
        $jobId = $scheduler->runParseChecker($crawl);
        if ($jobId === false || stripos($jobId, 'exception') !== false) {
            $this->Session->setFlash(__("任务失败。", true));
        } else {
            $this->Session->setFlash(__('任务已提交，请稍候等待结果。。。', true));
        }

        $nutchClient = new \Nutch\NutchClient ();
        $nutchConfig = $nutchClient->getNutchConfig($configId);
        $nutchConfig = filterNutchConfig($nutchConfig);

        $this->set(compact('crawl', 'jobId', 'nutchConfig'));
    }

    public function schedule()
    {
        $this->autoRender = false;

        if (ENABLE_NUTCH_JOB_AUTO_SCHEDULER) {
            App::import('Lib', 'nutch/job_scheduler');
            $scheduler = new \Nutch\JobScheduler ($this);
            $scheduler->setDebugMsg(false);
            $scheduler->schedule();

            echo json_encode([
                "status" => 'success',
                "code" => 0
            ]);
        } else {
            echo json_encode([
                "status" => 'disabled',
                "code" => 1,
                "message" => 'scheduler disabled'
            ]);
        }
    }

    public function listNutchConfigs()
    {
        $nutchClient = new \Nutch\NutchClient ();
        $nutchConfigs = $nutchClient->listNutchConfig();
        $nutchConfigs = qi_json_decode($nutchConfigs);

        $this->set(compact('nutchConfigs'));
    }

    public function nutchConfig($configId = null, $raw = false)
    {
        $nutchClient = new \Nutch\NutchClient ();
        if ($configId == null) {
            $nutchConfig = $nutchClient->listNutchConfig();
            $raw = true;
        } else {
            $nutchConfig = $nutchClient->getNutchConfig($configId);
            $nutchConfig = filterNutchConfig($nutchConfig);
        }

        $this->set(compact('nutchConfig', 'raw'));
    }

    public function urlFilterChecker()
    {
        $jobId = 0;

        if (!empty ($this->data)) {
            // $jobId = $scheduler->runParseChecker($crawl);
            if ($jobId === false) {
                $this->Session->setFlash(__('任务失败。。。', true));
            } else {
                $this->Session->setFlash(__('任务已提交，请稍候等待结果。。。', true));
            }
        }

        $this->set(compact('jobId'));
    }

    public function ajax_getStatus()
    {
        $this->autoRender = false;

        $client = new \Nutch\NutchClient ();
        $status = $client->getStatus();

        echo $status;
    }

    public function ajax_getNutchConfig($configId = null)
    {
        $this->autoRender = false;

        $client = new \Nutch\NutchClient ();
        $count = $client->getNutchConfig($configId);

        echo $count;
    }

    public function ajax_getFetchCount($configId = null)
    {
        $this->autoRender = false;

        $client = new \Nutch\NutchClient ();
        $count = $client->getNutchConfigPropert($configId, REPORT_FETCHED_PAGES);

        echo $count;
    }

    public function ajax_getFetchStatus($configId = null)
    {
        $this->autoRender = false;

        $client = new \Nutch\NutchClient ();
        $status = $client->getNutchConfigPropert($configId, REPORT_FETCH_STATUS);

        echo $status;
    }

    public function ajax_getJobInfo($jobId = null)
    {
        $this->autoRender = false;

        if (empty ($jobId)) {
            return getResponseStatusJson(404);
        }

        $client = new \Nutch\NutchClient ();
        echo $client->getjobInfo($jobId);
    }

    public function test_getFetchCount($jobId)
    {
        // update job status
        $client = new \Nutch\NutchClient ();
        $rawMsg = $client->getJobInfo($jobId);

        $jobInfo = qi_json_decode($rawMsg, true);

        pr($jobInfo);

        $data = [
            'id' => $jobInfo ['id'],
            'state' => $jobInfo ['state'],
            'args' => json_encode($jobInfo ['args'], JSON_PRETTY_PRINT),
            'msg' => $jobInfo ['msg'],
            'raw_msg' => $rawMsg,
            'fetch_count' => $this->_getFetchCount($jobInfo)
        ];

        pr($data);
    }

    /**
     *
     * @param
     *            $jobInfo
     * @return int
     *
     */
    private function _getFetchCount($jobInfo)
    {
        if ($jobInfo ['type'] != 'FETCH' || empty ($jobInfo ['result'] ['jobs'])) {
            return 0;
        }

        $count = 0;
        foreach ($jobInfo ['result'] ['jobs'] as $k => $job) {
            $count += $job ['counters'] ['FetcherStatus'] ['FetchedPages'];
        }

        return $count;
    }

    function stop($id)
    {
        $nutchJob = $this->NutchJob->read($id);

        $nutchClient = new Nutch\NutchClient ();
        $nutchClient->stopNutchJob($nutchJob ['NutchJob'] ['configId']);
    }

    function abort($id)
    {
    }

    function resume($id)
    {
        $nutchJob = $this->NutchJob->read($id);

        $nutchClient = new Nutch\NutchClient ();
        $nutchClient->stopNutchJob($nutchJob ['NutchJob'] ['configId']);
    }

    function admin_index()
    {
        $this->paginate ['NutchJob'] = array(
            'limit' => 300,
            'order' => 'NutchJob.id DESC'
        );
        $this->NutchJob->recursive = 0;
        $this->set('nutchJobs', $this->paginate());
    }

    function admin_view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid nutch job', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->set('nutchJob', $this->NutchJob->read(null, $id));
    }

    function admin_add()
    {
        if (!empty ($this->data)) {
            $this->NutchJob->create();
            if ($this->NutchJob->save($this->data)) {
                $this->Session->setFlash(__('The nutch job has been saved', true));
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
            }
        }

        $crawls = $this->NutchJob->Crawl->find('list');
        $users = $this->NutchJob->User->find('list');
        $this->set(compact('crawls', 'users'));
    }

    function admin_edit($id = null)
    {
        if (!$id && empty ($this->data)) {
            $this->Session->setFlash(__('Invalid nutch job', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        if (!empty ($this->data)) {
            if ($this->NutchJob->save($this->data)) {
                $this->Session->setFlash(__('The nutch job has been saved', true));
                $this->redirect(array(
                    'action' => 'index'
                ));
            } else {
                $this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
            }
        }
        if (empty ($this->data)) {
            $this->data = $this->NutchJob->read(null, $id);
        }
        $crawls = $this->NutchJob->Crawl->find('list');
        $users = $this->NutchJob->User->find('list');
        $this->set(compact('crawls', 'users'));
    }

    function admin_delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for nutch job', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        if ($this->NutchJob->delete($id)) {
            $this->Session->setFlash(__('Nutch job deleted', true));
            $this->redirect(array(
                'action' => 'index'
            ));
        }
        $this->Session->setFlash(__('Nutch job was not deleted', true));
        $this->redirect(array(
            'action' => 'index'
        ));
    }

    function admin_activeJobs($state = null)
    {
        $this->activeJobs($state);
    }

    function admin_plainActiveJobs($state = null)
    {
        $this->plainActiveJobs($state);
    }

    function admin_activeJob($jobId)
    {
        $this->activeJob($jobId);
    }

    private function _buildDummyCrawl($crawl_id = null)
    {
        $crawl = array(
            'Crawl' => array(
                'id' => $crawl_id,
                'crawlId' => null,
                'configId' => 'default',
                'user_id' => $this->currentUser ['id'],
                'test_url' => $this->data ['NutchJob'] ['url']
            ),
            'CrawlFilter' => array(
                array(
                    'page_type' => 'NONE',
                    'url_filter' => '',
                    'text_filter' => '',
                    'block_filter' => ''
                )
            )
        );

        return $crawl;
    }
}
