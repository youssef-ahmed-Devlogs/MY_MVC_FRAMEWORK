<?php

use App\Lib\FrontController;
use App\Lib\LanguageEngine;
use App\Lib\LayoutEngine;

require_once '../App/Config/config.php';
require_once '../App/Lib/Autoload.php';

$layoutConfig = require_once CONFIG_PATH . 'layoutConfig.php';
$layoutEngine = new LayoutEngine($layoutConfig);

$languageEngine = new LanguageEngine();

session_start();

$frontController = new FrontController($layoutEngine, $languageEngine);
$frontController->dispatch();
