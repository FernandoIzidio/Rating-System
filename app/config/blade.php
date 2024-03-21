<?php

use app\config\RootProject;

require_once '../app/config/config.php';
require_once '../vendor/autoload.php';


use Jenssegers\Blade\Blade;

$views = RootProject::getRootPath()->views;
$cache = RootProject::getRootPath()->cache;


return new Blade($views, $cache);