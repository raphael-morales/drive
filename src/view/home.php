
<main>
    <section class="hero">
        <h1>Bienvenue chez Drive</h1>
        <p>Faites vos courses en ligne et récupérez-les sans sortir de votre voiture</p>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
            <a href="index.php?page=listProducts" class="btn">Commencer vos achats</a>
        <?php } else { ?>
            <a href="index.php?page=signIn" class="btn">Connexion</a>
        <?php } ?>

    </section>
</main>
