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
<div style="display: flex">
    <div>
        <?= $this->profilsAdmin ?>
    </div>
    <section>
        <h1 class="text-center">Liste des employés</h1>
        <div class="profile-card mx-auto">
            <?php var_dump($this->profilsAdmin); ?>
        </div>
        <div class="profile-card mx-auto">
        </div>
    </section>
</div>

