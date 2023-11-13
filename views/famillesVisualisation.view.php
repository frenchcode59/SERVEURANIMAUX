<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Familles</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Famille</th>
            <th scope="col">Description</th>
            <th scope="col" colspan="2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($familles as $famille) : ?>
            <?php if (empty($_POST['famille_id']) || $_POST['famille_id'] !== $famille['famille_id']) : ?>
                <tr>
                    <td><?= htmlspecialchars($famille['famille_id']) ?></td>
                    <td><?= htmlspecialchars($famille['famille_libelle']) ?></td>
                    <td><?= htmlspecialchars($famille['famille_description']) ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="famille_id" value="<?= htmlspecialchars($famille['famille_id']) ?>" />
                            <button class="btn btn-warning btn-block" type="submit">Modifier</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="<?= htmlspecialchars(URL) ?>back/familles/validationSuppression" onSubmit="return confirm('Voulez-vous vraiment supprimer ?');">
                            <input type="hidden" name="famille_id" value="<?= htmlspecialchars($famille['famille_id']) ?>" />
                            <button class="btn btn-danger btn-block" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php else : ?>
                <tr>
                    <form method="post" action="<?= htmlspecialchars(URL) ?>back/familles/validationModification">
                        <td><?= htmlspecialchars($famille['famille_id']) ?></td>
                        <td>
                            <input type="text" name="famille_libelle" class="form-control" value="<?= htmlspecialchars($famille['famille_libelle']) ?>" />
                        </td>
                        <td>
                            <textarea name="famille_description" class="form-control" rows="3"><?= htmlspecialchars($famille['famille_description']) ?></textarea>
                        </td>
                        <td colspan="2">
                            <input type="hidden" name="famille_id" value="<?= htmlspecialchars($famille['famille_id']) ?>" />
                            <button class="btn btn-primary btn-block" type="submit">Valider</button>
                        </td>
                    </form>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php
$content = ob_get_clean();
$titre = "Page de création d'une famille";
require "views/commons/template.php";
