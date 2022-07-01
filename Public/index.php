<?php

use App\Lib\FrontController;

require_once '../App/config.php';
require_once '../App/Lib/Autoload.php';

session_start();

$frontController = new FrontController;
$frontController->dispatch();
