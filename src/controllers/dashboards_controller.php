<?php

class DashboardsController extends AppController
{

    public $uses = array(
        'Dashboard',
        'Solution'
    );

    public function index()
    {
        $faqs = json_decode(file_get_contents(APP_DATA . 'faqs.json', true), true);
        $solutions = $this->Solution->find('all');
        $this->set(compact('faqs', 'solutions'));
    }
}
