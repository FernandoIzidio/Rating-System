<?php 

function loadClass($class) {
    $class = str_replace("\\","/", $class);
    $class = preg_replace("/(BaseLogin|BaseRegister)/", "BaseController", $class);
    require_once "/var/www/Rating-System/" . $class . ".php";
}

spl_autoload_register("loadClass");

