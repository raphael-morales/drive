<h1 style="text-align: center"><?= $this->title ?></h1>

<div class="container-fluid d-flex flex-wrap justify-content-center">
    <?php if (empty($this->products)) { ?>
        <p>Votre panier est vide.</p>
    <?php } else { ?>
        <?php foreach ($this->products as $product) { ?>
            <div class="card m-3" style="width: 18rem;">
                <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto"
                     alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
                <div class="card-body" id= "<?= $product['product_id'] ?>">
                    <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                    <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                    <p class="card-text">Origine : <?= $product['product_origin'] ?></p>
                    <input class="card-text">Prix : <?= $product['product_price'] ?> €</input>
                    <input class="card-text">Quantité : <?= $product['product_client_quantity'] ?></input>
                    <button class="btn btn-danger">Retirer du panier</button>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
