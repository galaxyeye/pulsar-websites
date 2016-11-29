<?php

class LogsController extends AppController
{
    var $name = 'Logs';
    var $uses = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function u_index()
    {
    }
}
