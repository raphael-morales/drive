<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Drive.fr</title>
    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid px-3">
                <a class="navbar-brand" href="index.php">DRIVE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { ?>
                    <div class="d-flex ms-3">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=listProducts">Produits</a>
                            </li>
                            <li class="nav-item">
                                <?php if ($_SESSION['user']['role'] === 'administrateur') { ?>
                                    <a class="nav-link" href="index.php?page=addProduct">Ajouter</a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                    <form class="d-flex me-3" role="search" method="POST" action="index.php?page=listProducts">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                   name="searchQuery" value='<?= isset($_SESSION["searchQuery"]) ? $_SESSION["searchQuery"] : "" ?>'>
                            <button class="btn btn-outline-success" type="submit">Rechercher</button>
                        </form>
                    <?php } ?>
                    <div class="d-flex <?php if (!isset($_SESSION['user'])) echo "ms-auto" ?>">
                        <ul class="navbar-nav mb-2 mb-lg-0 d-flex align-items-center">
                            <?php if (isset($_SESSION['user']) AND !empty($_SESSION['user'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=myProfil" alt="lien vers la page mon profil">Bonjour, <?= $_SESSION["user"]["firstname"] ?></a>
                                </li>
                                <li class="nav-item position-relative">
                                    <?php if ($_SESSION['user']['role'] === 'utilisateur') { ?>
                                        <?php if (isset($_SESSION['user']['basket'])) { ?> 
                                            <span class="bg-danger text-light position-absolute top-0 end-0 rounded-circle px-2"><?php if (isset($_SESSION['user']['basket'])) echo count($_SESSION['user']['basket']) ?></span>
                                        <?php } ?>
                                        <a class="nav-link" href="index.php?page=shoppingCart"><img src="src/public/img/shoppingCart.svg" alt="panier" style="width: 48px"></a>
                                    <?php } ?>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?logout=true">Déconnexion</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=signIn">Connexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=signUp">Inscription</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

