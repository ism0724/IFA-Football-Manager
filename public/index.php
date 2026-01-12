<?php
require_once '../app/Core/Config.php';
require_once '../app/Core/Database.php';
require_once '../app/models/MembreModels.php';

use App\Models\MembreModel;

$model = new MembreModel();

// Test 1 : Récupérer les membres
$membres = $model->getAll();

echo "<pre>";
print_r($membres);
echo "</pre>";