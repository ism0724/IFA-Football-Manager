<?php
namespace App\Models;

use App\Core\Database;
use App\Entities\Joueur;
use App\Entities\Staff;

class MembreModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $sql = "SELECT m.*, r.libelle as role_nom 
                FROM membres m 
                JOIN roles r ON m.id_role = r.id";
        
        $query = $this->db->query($sql);
        $resultats = $query->fetchAll();

        $objetsMembres = [];

        foreach ($resultats as $data) {
       
            if ($data['role_nom'] === 'Joueur') {
                $objetsMembres[] = new Joueur($data);
            } else {
                
                $objetsMembres[] = new Staff($data);
            }
        }

        return $objetsMembres;
    }
}