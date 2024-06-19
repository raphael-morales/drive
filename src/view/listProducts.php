<h1 style="text-align: center"><?= $this->title ?></h1>
<div class="container-fluid d-flex justify-content-around">
<?php foreach($this->products as $product){ ?>
<div class="card" style="width: 18rem;">
    <img src="<?= $product['product_picture'] ?>" class="card-img-top m-auto" alt="<?= $product['product_name'] ?>" style="max-height:150px; max-width: 150px;">
    <div class="card-body">
        <h5 class="card-title"><?= $product['product_name'] ?></h5>
        <p class="card-text text-truncate"><?= $product['product_description'] ?></p>
        <p class="card-text">Origine : <?= $product['product_origin'] ?></p>
        <button class="btn btn-primary" <?=$product['product_quantity'] <= 0 ? "disabled" : "" ?>><?=$product['product_quantity'] <= 0 ? "Rupture de stock" : "Ajouter au panier" ?></button>
    </div>
</div>
<?php } ?>
</div>