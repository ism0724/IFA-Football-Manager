<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $titre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Inscription IFA Manager</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?action=store" method="POST">
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
                            <label class="form-label">Rôle au sein du club</label>
                            <select name="id_role" id="roleSelect" class="form-select" required>
                                <option value="">Choisir...</option>
                                <?php foreach($roles as $role): ?>
                                    <option value="<?= $role['id'] ?>"><?= $role['libelle'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="champJoueur" class="mb-3 d-none">
                            <label class="form-label">Catégorie du Joueur</label>
                            <select name="id_categorie" class="form-select">
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['nom_categorie'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div id="champStaff" class="mb-3 d-none">
                            <label class="form-label">Spécialité / Diplôme</label>
                            <input type="text" name="specialite" class="form-control" placeholder="Ex: Cardiologue, Licence CAF...">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success">Enregistrer le membre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Petit script pour afficher les bons champs selon le rôle
document.getElementById('roleSelect').addEventListener('change', function() {
    const roleTexte = this.options[this.selectedIndex].text;
    const divJoueur = document.getElementById('champJoueur');
    const divStaff = document.getElementById('champStaff');

    if (roleTexte === 'Joueur') {
        divJoueur.classList.remove('d-none');
        divStaff.classList.add('d-none');
    } else if (roleTexte !== "") {
        divStaff.classList.remove('d-none');
        divJoueur.classList.add('d-none');
    }
});
</script>
</body>
</html>