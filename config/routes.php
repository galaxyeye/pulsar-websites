<?php
// Home
Router::connect('/', ['controller' => 'dashboards', 'action' => 'index']);
Router::connect('/admin', ['controller' => 'dashboards', 'action' => 'index', 'admin' => true]);

Router::connect('/u', ['controller' => 'dashboards', 'action' => 'index', 'u' => true]);
//Router::connect('/u/topics', ['controller' => 'monitor_tasks', 'u' => true]);
//Router::connect('/u/topics/:action/*', ['controller' => 'monitor_tasks', 'u' => true]);

// Static - no databases
Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);

Inflector::rules('plural', [
    'irregular' => [
        'system' => 'system',
        'common' => 'common',
        'stat' => 'stat',
        'q' => 'q'
    ]
]);
