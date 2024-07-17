<h1 style="text-align: center"><?= $this->title ?></h1>

<form class="container-fluid d-flex flex-wrap justify-content-center">
    <?php if (empty($this->products)) { ?>
        <p>Votre panier est vide.</p>
    <?php } else { ?>
        <?php foreach ($_SESSION['user']['basket'] as $product_ordered) {
        ?>
            <?php foreach ($this->products as  $product) {
                if ($product_ordered["product_id"] == $product["product_id"]) {
            ?>
                    <div class="card m-3" style="width: 18rem;">
                        <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto" alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
                        <div class="card-body" id="<?= $product['product_id'] ?>">
                            <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                            <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                            <label for="product_price">Prix : </label>
                            <p class="card-text"><?= $product['product_price'] ?> €</p>
                            <span class="card-text">Quantité : <?= $product_ordered["quantity_ordered"] ?></span>
                            <select value="<?= $product_ordered["quantity_ordered"] ?>" name="quantity_ordered" id="quantity_ordered">
                                <?php for ($i = 1; $i <= $product['product_quantity']; $i++) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-danger">Retirer du panier</button>
                        </div>
                    </div>
            <?php }
            } ?>
        <?php } ?>
    <?php } ?>
</form>