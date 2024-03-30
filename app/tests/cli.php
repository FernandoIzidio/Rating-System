<?php

use app\models\SectorModel;

require_once "../config/cliLoader.php";

require_once "../../vendor/autoload.php";



        
$sectors = array_column(SectorModel::getAll(), "id_sector");

$idSector = $sectors[array_rand($sectors)];

print_r($sectors);

print_r($idSector);