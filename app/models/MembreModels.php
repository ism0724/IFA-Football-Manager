<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class MembreModel {
    private $db;

    public function __construct() {
        // On récupère la connexion unique via notre Singleton Database
        $this->db = Database::getConnection();
    }

    /**
     * Récupérer tous les membres avec leur rôle
     */
    public function getAll() {
        $sql = "SELECT m.*, r.libelle as role_nom 
                FROM membres m 
                JOIN roles r ON m.id_role = r.id 
                ORDER BY m.nom ASC";
        
        $query = $this->db->query($sql);
        return $query->fetchAll();
    }

    /**
     * Ajouter un nouveau membre (Joueur ou Staff)
     */
    public function create($data) {
        $sql = "INSERT INTO membres (id_role, nom, prenom, email, telephone, statut) 
                VALUES (:id_role, :nom, :prenom, :email, :telephone, :statut)";
        
        $stmt = $this->db->prepare($sql);
        
        // Sécurité : on "bind" les valeurs pour éviter les injections SQL
        return $stmt->execute([
            'id_role'   => $data['id_role'],
            'nom'       => $data['nom'],
            'prenom'    => $data['prenom'],
            'email'     => $data['email'],
            'telephone' => $data['telephone'],
            'statut'    => $data['statut'] ?? 'Actif'
        ]);
    }
}