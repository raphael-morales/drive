<h1 style="text-align: center"><?= $this->title ?></h1>

<div class="container-fluid d-flex flex-wrap justify-content-center">
    <?php if (empty($_SESSION['user']['basket'])) { ?>
        <p>Votre panier est vide.</p>
    <?php } else { ?>
        <?php foreach ($_SESSION['user']['basket'] as $product_ordered) {
        ?>
            <?php foreach ($this->products as  $product) {
                if ($product_ordered["product_id"] == $product["product_id"]) {
            ?>
                    <form action="" method="post">
                        <div class="card m-3" style="width: 18rem;">
                            <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto"
                                 alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
                            <div class="card-body" id="<?= $product['product_id'] ?>">
                                <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                                <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                                <label for="product_price">Prix : </label>
                                <p class="card-text"><?= $product['product_price'] ?> €</p>
                                <span class="card-text">Quantité :
                                <select name="product_quantity_ordered" id="product_quantity_ordered">
                                    <?php for ($i = 1; $i <= $product['product_quantity']; $i++) { ?>
                                        <?php if ($i == $product_ordered["product_quantity_ordered"]) { ?>
                                            <option selected value="<?= $i ?>"><?= $i ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </span>
                            </div>
                            <button type="submit" name="idProduct" value="<?= $product['product_id'] ?>" class="btn btn-danger">Retirer du panier</button>
                        </div>
                    </form>
            <?php }
            } ?>
        <?php } ?>
    <?php } ?>
</div>
<a href="index.php?page=shoppingCart&valid=true" alt="Terminer ma commande" class="btn btn-down">Terminer ma commande</a>
