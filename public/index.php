<?php
//APP入口

// PUBLIC_PATH
define('PUBLIC_PATH', __DIR__);

// bootstrap
require PUBLIC_PATH . '/../bootstrap.php';

// Routes and Begin processing
require CONF_PATH . '/routes.php';