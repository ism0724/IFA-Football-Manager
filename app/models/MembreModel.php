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
        $sql = "SELECT m.*, r.libelle as role_nom, c.nom_categorie
        FROM membres m 
        JOIN roles r ON m.id_role = r.id 
        LEFT JOIN affectations_categories a ON m.id = a.id_membre AND a.date_fin IS NULL
        LEFT JOIN categories c ON a.id_categorie = c.id
        ORDER BY m.nom ASC";
        
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
    public function saveComplet($data) {
        try {
            //  sécurité atomique
            $this->db->beginTransaction();
    
            // Insertion dans la table principale 'membres'
            $sqlMembre = "INSERT INTO membres (id_role, nom, prenom, email, statut) 
                          VALUES (:id_role, :nom, :prenom, :email, 'Actif')";
            $stmt = $this->db->prepare($sqlMembre);
            $stmt->execute([
                'id_role' => $data['id_role'],
                'nom'     => $data['nom'],
                'prenom'  => $data['prenom'],
                'email'   => $data['email']
            ]);

            $idMembre = $this->db->lastInsertId();
    
           
            if (!empty($data['id_categorie'])) {
                $sqlJoueur = "INSERT INTO affectations_categories (id_membre, id_categorie, date_debut) 
                              VALUES (:id_membre, :id_cat, CURDATE())";
                $this->db->prepare($sqlJoueur)->execute([
                    'id_membre' => $idMembre,
                    'id_cat'    => $data['id_categorie']
                ]);
            } elseif (!empty($data['specialite'])) {
              
                $sqlStaff = "INSERT INTO staff_details (id_membre, specialite) 
                             VALUES (:id_membre, :spec)";
                $this->db->prepare($sqlStaff)->execute([
                    'id_membre' => $idMembre,
                    'spec'      => $data['specialite']
                ]);
            }
    
            //on valide définitivement
            $this->db->commit();
            return true;
    
        } catch (\Exception $e) {
            // En cas d'erreur, on annule
            $this->db->rollBack();
            return false;
        }
    }
}