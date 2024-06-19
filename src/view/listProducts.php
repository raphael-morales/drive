<h1 style="text-align: center"><?= $this->title ?></h1>
<div class="d-flex justify-content-center">
    <?php foreach ($this->categories as $category) {
        echo '<button type="button" class="btn btn-light">
                <a style="text-decoration: none; color: black" href="index.php?page=listProducts&category='.$category["category_id"].'">    
                    '.$category["category_name"].'
                </a>
              </button>';
        }
    ?>
</div>

<div class="container-fluid d-flex flex-wrap justify-content-center ">
    <?php foreach ($this->products as $product) { ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto"
                 alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
            <div class="card-body">
                <h5 class="card-title text-truncate"><?= $product['product_name'] ?></h5>
                <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
                <p class="card-text">Origine : <?= $product['product_origin'] ?></p>
                <p class="card-text">Prix : <?= $product['product_price'] ?> €</p>
                <button class="btn btn-primary" <?= $product['product_quantity'] <= 0 ? "disabled" : "" ?>><?= $product['product_quantity'] <= 0 ? "Rupture de stock" : "Ajouter au panier" ?></button>
            </div>
        </div>
    <?php } ?>
</div>