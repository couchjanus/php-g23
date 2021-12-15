<?php
define('ROOT', dirname(__DIR__));
define('ROUTES', require_once ROOT.'/config/routes.php');
define('STORAGE', $_SERVER['DOCUMENT_ROOT'].'/storage');

const CONTROLLERS = "\\App\Controllers\\";
const VIEWS = ROOT.'/app/Views';

require_once __DIR__."/autoload.php";

(new Core\App())->run();
