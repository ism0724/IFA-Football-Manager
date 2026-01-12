<?php
namespace App\Entities;

class Staff extends Membre {
    private $specialite;

    public function __construct(array $data) {
        parent::__construct($data);
        // La spécialité peut venir de la table staff_details ou du libellé du rôle
        $this->specialite = $data['role_nom'] ?? 'Administratif';
    }

    public function getDescription() {
        return "Personnel Technique - Poste : " . $this->specialite;
    }
}