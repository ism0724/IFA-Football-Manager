<?php
namespace App\Entities;

abstract class Membre {
    protected $id;
    protected $id_role;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $statut;

    public function __construct(array $data) {
        $this->id = $data['id'] ?? null;
        $this->id_role = $data['id_role'] ?? null;
        $this->nom = $data['nom'] ?? '';
        $this->prenom = $data['prenom'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->statut = $data['statut'] ?? 'Actif';
    }

    // Une méthode commune pour l'affichage
    public function getNomComplet() {
        return strtoupper($this->nom) . " " . ucfirst($this->prenom);
    }
    public function getEmail() {
        return $this->email;
    }

    // caractéristique de chaque objet
    abstract public function getDescription();
}