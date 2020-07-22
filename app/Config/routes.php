<?php
Router::connect('/', array('controller' => 'pages', 'action' => 'index'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
