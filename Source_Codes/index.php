<?php 

    require_once 'parts/conf.php';
    require_once 'inc/basics_functions.php';
    require_once 'inc/databases_functions.php';

    $titleWebPage = 'Accueil';
    require_once 'parts/header.php';
    
    $db = connectDB(DB_CREDIENTIAL);
    $dataInterventions = readInterventions($db);

?>

    <header id='mainHeader'>
        <div class="logo">
            <h1>Immo Manager</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="#">Ajouter</a></li>
            </ul>
        </nav>
    </header>

    <main id='mainContent'>
        <h2>Interventions existantes:</h2>
        <section id="dataView">
            <table>
                <thead>
                    <tr>
                        <td>Identifiant</td>
                        <td>Intitulé</td>
                        <td>Date</td>
                        <td>Etage</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataInterventions as $data): ?>
                        <tr>
                            <td><?= $data['id'] ?></td>
                            <td><input type="text" value='<?= $data['name'] ?>'></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= $data['floor'] ?></td>
                            <td><a href="parts/edit.php?id=<?= $data['id']?>">Editer</a><a href="parts/delete.php?id=<?= $data['id']?>">Supprimer</a><a href="parts/view.php?id=<?= $data['id']?>">Détails</a></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>

<?php require_once 'parts/footer.php'; ?>