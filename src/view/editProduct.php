<h1 style="text-align: center"><?= $this->title ?></h1>
<form action="index.php?page=editProduct&product_id=<?= $this->product['product_id'] ?>" method="post" style="width: 60%; margin: auto" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label for="name" class="form-label">Nom du Produit</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $this->product['product_name'] ?>">
    </div>
    <div class="form-group mb-3">
        <label for="category">Catégorie</label>
        <select class="form-control" id="category" name="category">
            <?php foreach ($this->categories as $cat) {
                if ($cat['category_id'] === $this->product['product_category_id']){
                    echo "<option selected value='{$cat['category_id']}'>{$cat['category_name']}</option>";
                }else{
                    echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
                }

            } ?>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="picture" class="form-label">Image du Produit</label>
        <input type="file" class="form-control" name="picture" id="picture">
        <img src="<?= $this->product['product_picture'] ?>" style="max-height:150px; max-width:150px;">
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description"><?= $this->product['product_description'] ?></textarea>
    </div>
    <div class="form-group mb-3">
        <label for="origin" class="form-label">Origine</label>
        <input type="text" class="form-control" name="origin" id="origin" value="<?= $this->product['product_origin'] ?>">
    </div>
    <div class="form-group mb-3">
        <label for="quantity" class="form-label">Quantité</label>
        <input type="number" class="form-control" name="quantity" id="quantity" value="<?= $this->product['product_quantity'] ?>">
    </div>
    <div class="form-group mb-3">
        <label for="price" class="form-label">Prix</label>
        <input type="number" step="0.01" class="form-control" name="price" id="price" value="<?= $this->product['product_price'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
    <button type="submit" name="delete" class="btn btn-danger">Supprimer le Produit</button>
</form>
