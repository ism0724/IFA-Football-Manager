<?php
require_once '../app/Autoloader.php';
\App\Autoloader::register();

<<<<<<< HEAD
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
=======
use App\Models\MembreModel;
use App\Entities\Joueur;
use App\Entities\Staff;

try {
    $membreModel = new MembreModel();
    $membres = $membreModel->getAll();

    echo "<h1>Test du Système IFA Manager</h1>";

    foreach ($membres as $membre) {
        echo "<div>";
        echo "<strong>Nom Complet :</strong> " . $membre->getNomComplet() . "<br>";
        echo "<strong>Description :</strong> " . $membre->getDescription() . "<br>";
        
        if ($membre instanceof Joueur) {
            echo "<em>Type détecté : Objet Joueur</em>";
        } elseif ($membre instanceof Staff) {
            echo "<em>Type détecté : Objet Staff</em>";
        }
        echo "</div><hr>";
    }

} catch (Exception $e) {
    echo "Erreur lors du test : " . $e->getMessage();
}
>>>>>>> 0447d114f566acafb7bc89d9e50632ee7660e632
