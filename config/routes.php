<?php 
	// Home
  Router::connect('/', array('controller' => 'properties', 'action' => 'index'));
  Router::connect('/admin', array('controller' => 'properties', 'action' => 'index', 'admin' => true));

	// Static - no databases
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
?>
