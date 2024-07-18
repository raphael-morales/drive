<h1 style="text-align: center"><?= $this->title ?></h1>

<div class="container-fluid d-flex flex-column flex-wrap justify-content-center pb-3" style="min-height: 86.5vh">
    <?php if (empty($_SESSION['user']['basket'])) { ?>
        <p class="text-center">Votre panier est vide.</p>
    <?php } else { ?>
        <div class="d-flex justify-content-center">
            <?php foreach ($_SESSION['user']['basket'] as $product_ordered) {
            ?>
                <?php foreach ($this->products as $product) {
                    if ($product_ordered["product_id"] == $product["product_id"]) {
                ?>
                        <div class="card m-3 py-3" style="width: 18rem;">
                            <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto" alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
                            <div class="card-body" id="<?= $product['product_id'] ?>">
                                <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                                <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                                <p>
                                    <label for="product_price">Prix unitaire : </label>
                                    <span class="card-text"><?= $product['product_price'] ?> €</span>
                                </p>
                            </div>
                            <form action="" method="post" class="px-3">
                                <label class="card-text">Quantité : </label>
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <select name="quantity_ordered" id="quantity_ordered">
                                    <?php for ($i = 1; $i <= $product['product_quantity']; $i++) { ?>
                                        <?php if ($i == $product_ordered["quantity_ordered"]) { ?>
                                            <option selected value="<?= $i ?>"><?= $i ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <button type="submit" class="btn btn-danger">valider</button>
                            </form>
                            <p class="px-3">Prix total : <?= $product_ordered["quantity_ordered"] * $product_ordered["product_price"] ?> € </p>
                            <form action="" method="post" class="px-3 w-100 d-flex justify-content-center">
                                <input type="hidden" name="idProduct" value="<?= $product['product_id'] ?>">
                                <button type="submit" class="btn btn-danger">Retirer du panier</button>
                            </form>
                        </div>
                <?php }
                } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if (!empty($_SESSION['user']['basket'])) { ?>
        <div class="d-flex flex-column mt-auto">
            <p class="px-3 fs-3 fw-bold ms-auto ">Total à payer : <?= $this->total2pay ?> € </p>
            <form method="post" action="index.php?page=paymentBasket" class="d-flex justify-content-center">
                <input type="hidden" name="total2Pay" id="total2pay" value="<?= $this->total2pay ?>">
                <button type="submit" class="btn btn-danger">Terminer ma commande</button>
            </form>
        </div>
    <?php } ?>
</div>