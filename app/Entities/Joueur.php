<?php
namespace App\Entities;

class Joueur extends Membre {
    private $categorie;

    public function __construct(array $data) {
        // On transmet les données de base au parent (Membre)
        parent::__construct($data);
        // On gère la donnée spécifique au joueur
        $this->categorie = $data['nom_categorie'] ?? 'N/A';
    }

    public function getDescription() {
        return "Athlète - Catégorie : " . $this->categorie;
    }
}