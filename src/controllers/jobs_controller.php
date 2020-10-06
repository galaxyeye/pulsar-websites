<?php

require_once APP_DATA . "jobs.php";

class JobsController extends AppController
{
    public function index() {
        $this->set("fullscreen", true);
        $this->set("jobs", JOBS);
    }
}
