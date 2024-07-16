<h1 style="text-align: center"><?= $this->title ?></h1>
<?php var_dump($_SESSION) ?>
<div class="d-flex flex-wrap gap-2 w-75 mx-auto justify-content-evenly py-2">
    <?php foreach ($this->categories as $category) {
        echo '<button type="button" class="btn btn-primary w-25 text-truncate ">
                <a class="text-light" href="index.php?page=listProducts&category='.$category["category_id"].'">    
                    '.$category["category_name"].'
                </a>
              </button>';
        }
    ?>
    <button class="btn btn-primary w-25 text-truncate">
        <a class="text-light" href="index.php?page=listProducts">Tous les produits</a>
    </button>
</div>
<?php //var_dump($this->products); ?>

<form class="d-flex justify-content-center gap-2 m-4" action="" method="post">
    <select class="form-select w-25" aria-label="Default select example" name="price">
        <option selected>Filtre par prix</option>
        <option value="ASC">Prix croissant</option>
        <option value="DESC">Prix décroissant</option>
    </select>
    <button type="submit" class="btn btn-light">trier par prix</button>
</form>

<div class="container-fluid d-flex flex-wrap justify-content-center gap-2">
    <?php foreach ($this->products as $product) { ?>
        <div class="card p-2" style="width: 18rem;">
            <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto"
                 alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
            <div class="card-body">
                <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                <p class="card-text">Origine : <?= $product['product_origin'] ?></p>
                <p class="card-text">Prix : <?= $product['product_price'] ?> €</p>

                <button class="btn btn-primary" <?= $product['product_quantity'] <= 0 ? "disabled" : "" ?>><?= $product['product_quantity'] <= 0 ? "Rupture de stock" : "Ajouter au panier" ?></button>
                <?php if ($this->isAdmin) { ?>
                    <button class="btn btn-danger">
                        <a class="text-light" href="index.php?page=editProduct&product_id=<?= $product['product_id'] ?>">Modifier le produit</a>
                    </button>
                <?php } ?>

                <form action="" method="POST">
                    <button class="btn btn-primary" <?= $product['product_quantity'] <= 0 ? "disabled" : "" ?>><?= $product['product_quantity'] <= 0 ? "Rupture de stock" : "Ajouter au panier" ?></button>
                    <select  name="quantityOrdered" id="quantityOrdered" >
                        <?php for ($i = 1; $i <= $product['product_quantity']; $i++) {?>
                            <option value="<?= $i?>"><?= $i?></option>
                        <?php }?>
                    </select>
                </form>

            </div>
        </div>
    <?php } ?>
</div>