<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?></title>
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <section>
        <h1 class="text-center"><?= $this->title ?></h1>
        <div class="profile-card mx-auto">
            <p>Prénom : <?= $this->profil["user_firstname"] ?></p>
            <p>Nom : <?= $this->profil["user_lastname"] ?></p>
            <p>Date de naissance : <?= $this->profil["user_birthday"] ?></p>
            <p>Email : <?= $this->profil["user_email"] ?></p>
            <p>Téléphone : <?= $this->profil["user_phone"] ?></p>
            <p>Adresse : <?= $this->profil["user_address"] ?></p>
            <p>Code postale : <?= $this->profil["user_zipcode"] ?></p>
            <p>Ville : <?= $this->profil["user_city"] ?></p>
        </div>
    </section>
</body>
</html>