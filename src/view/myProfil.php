<div style="display: flex; justify-content: space-around">
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
    <section>
        <h1 class="text-center">Liste des commandes en cours</h1>
        <div class="order-card mx-auto">
            <?= $this->orders ?>
        </div>
    </section>

    <section class="order-modal" style="<?= isset($_POST['Commande']) ? 'display: block' : 'display:none' ?>; width: 30%">
        <?php if (isset($_POST['Commande'])){ ?>
        <h1 class="text-center">commande N°<?= $_POST['Commande'] ?></h1>
        <div class="order-card mx-auto">
            <?php foreach ($this->orderUser as $product){ ?>
                <p style="text-overflow: ellipsis;"><b>Produit</b> : <?= $product["product_name"] ?></p>
                <p>Quantité : <?= $product["order_products_product_quantity"] ?></p>
                <hr>
            <?php } ?>
            <p style="text-align: end;"><b>Total :<?= $this->totalPrice ?> €</b></p>
        </div>
        <?php } ?>
    </section>
</div>
<div>
    <?php if ($this->profilsAdmin){ ?>
        <section>
            <div class="profile-card-table mx-auto m-1">
                <h1 class="text-center">Liste des administrateurs</h1>
                <?= $this->profilsAdmin ?>
            </div>
        </section>
    <?php } ?>
    <?php if ($this->profilsEmployee){ ?>
        <section>
            <div class="profile-card-table mx-auto m-1">
                <h1 class="text-center">Liste des employés</h1>
                <?= $this->profilsEmployee ?>
            </div>
        </section>
    <?php } ?>
    <?php if ($this->profilsUsers){ ?>
        <section>
            <div class="profile-card-table mx-auto m-1">
                <h1 class="text-center">Liste des utilisateurs</h1>
                <?= $this->profilsUsers ?>
            </div>
        </section>
    <?php } ?>
</div>

