<?php
// Home
Router::connect('/', ['controller' => 'dashboards', 'action' => 'index']);
Router::connect('/admin', ['controller' => 'dashboards', 'action' => 'index', 'admin' => true]);

// Static - no databases
Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);

Inflector::rules('plural', [
    'irregular' => [
        'system' => 'system',
        'common' => 'common',
        'stat' => 'stat'
    ]
]);
