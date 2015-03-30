<?php 
class JobsController extends AppController {

  var $name = 'Jobs';

  function index() {
    $this->loadModel("NutchJob");
    $this->NutchJob->recursive = -1;
    $nutchJobs = $this->NutchJob->find('all', [
        'conditions' => ['NutchJob.user_id' => $this->currentUser['id']],
        'limit' => 5,
        'order' => 'NutchJob.id DESC']
    );

    $this->loadModel("ScentJob");
    $this->ScentJob->recursive = -1;
    $scentJobs = $this->ScentJob->find('all', [
    		'ScentJob.user_id' => $this->currentUser['id'],
        'limit' => 5,
    		'order' => 'ScentJob.id DESC']
    );

    $this->set(compact('nutchJobs', 'scentJobs'));

    $this->loadModel("SparkJob");
    $this->SparkJob->recursive = -1;
    $sparkJobs = $this->SparkJob->find('all', [
        'SparkJob.user_id' => $this->currentUser['id'],
    		'limit' => 5,
    		'order' => 'SparkJob.id DESC']
    );

    $this->set(compact('nutchJobs', 'scentJobs', 'sparkJobs'));
  }
}
