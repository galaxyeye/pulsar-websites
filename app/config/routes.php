<?php 
	// Home
  Router::connect('/', array('controller' => 'dashboards', 'action' => 'index'));
  Router::connect('/admin', array('controller' => 'dashboards', 'action' => 'index', 'admin' => true));

  // Static - no databases
  Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
