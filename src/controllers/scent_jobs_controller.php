<?php
\App::import('Lib', array('scent/scent_client'));

class ScentJobsController extends AppController
{

    var $name = 'ScentJobs';

    var $paginate = ['ScentJob' => ['limit' => 500, 'order' => 'ScentJob.id DESC']];

    function index()
    {
        $this->paginate['ScentJob'] = array('limit' => 500, 'order' => 'ScentJob.id DESC');
        $this->ScentJob->recursive = 0;
        $this->set('scentJobs', $this->paginate(['ScentJob.user_id' => $this->currentUser['id']]));
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!$this->checkTenantPrivilege($id)) {
            $this->Session->setFlash(__('Privilege denied', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->set('scentJob', $this->ScentJob->read(null, $id));
    }

    function ajax_getStatus()
    {
        $this->autoRender = false;

        $client = new \Scent\ScentClient();
        $status = $client->getStatus();

        echo $status;
    }

    function ajax_getJobInfo($id, $realTime = false)
    {
        $this->autoRender = false;

        $errno = 0;
        if (empty($id)) {
            return getResponseStatusJson(404);
        }

        if (!$this->checkTenantPrivilege($id)) {
            return getResponseStatusJson(401);
        }

        $this->ScentJob->recursive = -1;
        $scentJob = $this->ScentJob->read(null, $id);
        $rawMsg = $scentJob['ScentJob']['raw_msg'];

        if ($realTime && !empty($scentJob['ScentJob']['jobId'])) {
            $client = new \Scent\ScentClient();
            $rawMsg = $client->getjobInfo($scentJob['ScentJob']['jobId']);

            if (empty($rawMsg) || striContains($rawMsg, '{"exception')) {
                $this->log("Failed to get JobInfo" . $rawMsg);
                return getResponseStatusJson(500);
            }

            $results = qi_json_decode($rawMsg, true, 10);

            $this->ScentJob->id = $id;
            $this->ScentJob->save(array(
                'id' => $id,
                'confId' => $results['confId'],
                'state' => $results['state'],
                'msg' => $results['msg'],
                'raw_msg' => $rawMsg
            ));
        }

        echo $rawMsg;
    }

    /**
     * TODO : This is a temporary approach to show the extract result
     * */
    function ajax_getExtractResultAsSQL($id, $limit = 100)
    {
        $this->autoRender = false;

        $this->ScentJob->recursive = -1;
        $scentJob = $this->ScentJob->read(null, $id);
        $sqls = $this->_getExtractResultSQL($scentJob, $limit);

        echo json_encode($sqls);
    }

    /**
     * TODO :
     *   1. This is a temporary approach to show the extract result
     *   2. rename to be viewExtractResultAsSQL
     * */
    function viewExtractResult($id, $limit = 100)
    {
        $this->_validateId($id);

        $scentJob = $this->ScentJob->read(null, $id);
        $sqls = $this->_getExtractResultSQL($scentJob, $limit);

        $this->set(compact('scentJob', 'sqls'));
    }

    function _getExtractResultSQL($scentJob, $limit)
    {
        $sqls = $this->_getExtractResult($scentJob);

        if (empty($sqls)) {
            return array();
        }

        $sqls = explode("\n", $sqls);

        $sqls2 = $sqls;
        $sqls = array();

        // TODO : a simple method?
        for ($i = 0; $i < min(count($sqls2), $limit); ++$i) {
            if (!empty($sqls2[$i])) array_push($sqls, $sqls2[$i]);
        }

        return $sqls;
    }

    function downloadExtractResult($id)
    {
        $this->_validateId($id);
        $this->view = 'Media';

        $this->ScentJob->recursive = -1;
        $scentJob = $this->ScentJob->read(null, $id);
        $rawMsg = $scentJob['ScentJob']['raw_msg'];
        $results = qi_json_decode($rawMsg, true, 10);

        $path = '/tmp/scent-extract/' . $results['result']['OutFolder'] . DS;
        $params = array(
            'id' => 'part-r-00000',
            'name' => 'extract' . $scentJob['ScentJob']['jobId'],
            'download' => true,
            'extension' => 'sql.txt',  // must be lower case
            'path' => $path   // don't forget terminal 'DS'
        );

        $this->set($params);
    }

    // TODO : Save extract result in HDFS/HBASE
    function _getExtractResult($scentJob)
    {
        $rawMsg = $scentJob['ScentJob']['raw_msg'];
        $results = qi_json_decode($rawMsg, true, 10);

        if (!isset($results['result']['OutFolder'])) {
            return null;
        }

        $file = '/tmp/scent-extract/' . $results['result']['OutFolder'] . DS . 'part-r-00000';
        if (!file_exists($file)) {
            return null;
        }

        $content = file_get_contents($file);

        return $content;
    }

    function ajax_extract()
    {
        $this->autoRender = false;

        $url = $this->params['form']['url'];
        $html = $this->params['form']['html'];
        $format = $this->params['form']['format'];

        $this->params['form']['html'] = "";

        if (empty($html) || empty($format)) {
            return getResponseStatusJson(400);
        }

//        $results = Cache::read("extract-" . $url, 'minute');
//        if ($results == null) {
//            $scentClient = new \Scent\ScentClient();
//            $results = $scentClient->extract(['-html' => $html, '-format' => $format]);
//
//            Cache::write("extract-" . $url, $results, 'minute');
//        }

        $scentClient = new \Scent\ScentClient();
        $results = $scentClient->extract(['-html' => $html, '-format' => $format]);

        return $results['content'];
    }

    function admin_index()
    {
        $this->paginate['ScentJob'] = array('limit' => 500, 'order' => 'ScentJob.id DESC');
        $this->ScentJob->recursive = 0;
        $this->set('scentJobs', $this->paginate());
    }

    function admin_view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->set('scentJob', $this->ScentJob->read(null, $id));
    }
}
