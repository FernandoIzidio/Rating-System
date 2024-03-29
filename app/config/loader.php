<?php 

function loadClass($class) {
    $class = str_replace("\\","/", $class);
    $class = preg_replace("/(BaseLogin|BaseRegister)/", "BaseController", $class);
    echo "../" . $class .".php";
    echo "<br>";
    require_once "../" . $class . ".php";
}

spl_autoload_register("loadClass");

