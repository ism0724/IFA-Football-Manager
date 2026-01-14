<?php
require_once '../app/Autoloader.php';
\App\Autoloader::register();

use App\Controllers\MembresController;


$controller = new MembresController();
$action = $_GET['action'] ?? 'index';
// test

switch ($action) {
    case 'store':
        $controller->store();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
use App\Models\MembreModel;
use App\Entities\Joueur;
use App\Entities\Staff;

try {
    $membreModel = new MembreModel();
    $membres = $membreModel->getAll();



} catch (Exception $e) {
    echo "Erreur lors du test : " . $e->getMessage();
}
