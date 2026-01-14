<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .badge-staff { background-color: #0d6efd; }
        .badge-joueur { background-color: #198754; }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people-fill"></i> Gestion des Membres</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjout">
    + Ajouter un membre
</button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom Complet</th>
                        <th>Type</th>
                        <th>Détails / Catégorie</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($membres as $membre): ?>
                    <tr>
                        <td><strong><?= $membre->getNomComplet() ?></strong></td>
                        <td>
                            <?php 
                                // On utilise "instanceof" pour adapter le badge visuel
                                $badgeClass = ($membre instanceof \App\Entities\Joueur) ? 'badge-joueur' : 'badge-staff';
                                $typeLabel = ($membre instanceof \App\Entities\Joueur) ? 'Joueur' : 'Staff';
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= $typeLabel ?></span>
                        </td>
                        <td><?= $membre->getDescription() ?></td>
                        <td><?= $membre->getEmail() ?></td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary">Modifier</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAjout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="index.php?action=store" method="POST">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Nouveau Membre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rôle</label>
                        <select name="id_role" id="roleSelect" class="form-select" required>
                            <option value="">Choisir...</option>
                            <?php foreach($roles as $role): ?>
                                <option value="<?= $role['id'] ?>"><?= $role['libelle'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div id="champJoueur" class="mb-3 d-none">
                        <label class="form-label">Catégorie</label>
                        <select name="id_categorie" class="form-select">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['nom_categorie'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="champStaff" class="mb-3 d-none">
                        <label class="form-label">Spécialité</label>
                        <input type="text" name="specialite" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('roleSelect').addEventListener('change', function() {
    const roleTexte = this.options[this.selectedIndex].text;
    const divJoueur = document.getElementById('champJoueur');
    const divStaff = document.getElementById('champStaff');

    divJoueur.classList.add('d-none');
    divStaff.classList.add('d-none');

    if (roleTexte === 'Joueur') {
        divJoueur.classList.remove('d-none');
    } else if (roleTexte !== "") {
        divStaff.classList.remove('d-none');
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>