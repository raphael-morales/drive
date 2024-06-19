<h1 style="text-align: center"><?= $this->title ?></h1>
<form action="" method="post" style="width: 60%; margin: auto" enctype="multipart/form-data">
    <div class="form-group mb-3">
        <label for="name" class="form-label">Nom du Produit</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group mb-3">
        <label for="category">Catégorie</label>
        <select class="form-control" id="category" name="category">
            <option value=''>- -</option>
            <?php foreach ($this->categories as $cat) {
                echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
            } ?>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="picture" class="form-label">Image du Produit</label>
        <input type="file" class="form-control" name="picture" id="picture">
    </div>
    <div class="form-group mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description"></textarea>
    </div>
    <div class="form-group mb-3">
        <label for="origin" class="form-label">Origine</label>
        <input type="text" class="form-control" name="origin" id="origin">
    </div>
    <div class="form-group mb-3">
        <label for="quantity" class="form-label">Quantité</label>
        <input type="number" class="form-control" name="quantity" id="quantity">
    </div>
    <div class="form-group mb-3">
        <label for="price" class="form-label">Prix</label>
        <input type="number" class="form-control" name="price" id="price">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
