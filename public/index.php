<?php
require_once '../app/Core/Config.php';
require_once '../app/Core/Database.php';

use App\Core\Database;

try {
    $db = Database::getConnection();
    echo "Félicitations ! IFA Manager est connecté à MySQL via le fichier .env";
} catch (Exception $e) {
    echo "Échec : " . $e->getMessage();
}