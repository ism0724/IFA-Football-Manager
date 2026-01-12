<?php
require_once '../app/Autoloader.php';
\App\Autoloader::register();

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