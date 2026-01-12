<?php

namespace App\Controllers;

use App\Models\MembreModel;

class MembresController {

    /**
     * Cette méthode affiche la liste de tous les membres
     */
    public function index() {
        $model = new MembreModel();
        $membres = $model->getAll();
    
        // On récupère les listes pour le formulaire du popup
        $db = \App\Core\Database::getConnection();
        $roles = $db->query("SELECT * FROM roles")->fetchAll();
        $categories = $db->query("SELECT * FROM categories")->fetchAll();
    
        $titre = "Gestion des Membres - IFA Manager";
        require_once '../app/Views/membres/index.php';
    }
    public function create() {
        $titre = "Ajouter un nouveau membre";
        $db = \App\Core\Database::getConnection();
        $roles = $db->query("SELECT * FROM roles")->fetchAll();
        $categories = $db->query("SELECT * FROM categories")->fetchAll();
    
        require_once '../app/Views/membres/formulaire.php';
    }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new MembreModel();
            
            // On prépare les données reçues du formulaire
            $data = $_POST;
    
            // On appelle une méthode du modèle pour sauvegarder
            $success = $model->saveComplet($data);
    
            if ($success) {
                // Redirection vers la liste avec un message de succès
                header('Location: index.php?status=success');
            } else {
                header('Location: index.php?status=error');
            }
            exit;
        }
    }
}


