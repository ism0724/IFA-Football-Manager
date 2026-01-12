<?php


require_once '../app/Autoloader.php';
\App\Autoloader::register();


use App\Core\Config;
use App\Core\Database;
use App\Models\MembreModel;

try {
    $model = new MembreModel();
    $membres = $model->getAll();
    
    echo "L'autoloader fonctionne ! Nombre de membres : " . count($membres);
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage();
}