<?php

class EditProductController
{
    public $model;
    public $msg;
    public $title;
    public $categories;
    public $param;
    public $altParam;
    public $displayValue;
    public $product;

    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Modifier le Produit";
        $this->categories = $this->model->getCategories();
        $this->param = "index.php?page=editProduct";
        $this->altParam = "retour";
        $this->displayValue = "Retour";
    }

    public function manage()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'administrateur') {
            header('Location: index.php?page=signIn');
            exit();
        }

        if (isset($_GET['product_id'])) {
            $productId = $_GET['product_id'];
            $this->product = $this->model->getProductById($productId);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['delete'])) {
                    $result = $this->model->deleteProduct($productId);
                    if ($result) {
                        $this->msg = "Produit supprimé avec succès.";
                        header('Location: index.php?page=listProducts');
                        exit();
                    } else {
                        $this->msg = "La suppression du produit a échoué.";
                    }
                } else {

                    $name = $_POST['name'] ?? null;
                    $category = $_POST['category'] ?? null;
                    $description = $_POST['description'] ?? null;
                    $origin = $_POST['origin'] ?? null;
                    $quantity = $_POST['quantity'] ?? null;
                    $price = $_POST['price'] ?? null;
                    $picture = $this->product['product_picture'];

                    if ($name && $category && $description && $origin && $quantity && $price) {
                        $result = $this->model->updateProduct(
                            $productId,
                            $name,
                            $category,
                            $picture,
                            $description,
                            $origin,
                            $quantity,
                            $price);
                        if ($result) {
                            $this->msg = "Produit mis à jour avec succès.";
                            header('Location: index.php?page=listProducts');
                            exit();
                        } else {
                            $this->msg = "La mise à jour du produit a échoué.";
                        }
                    } else {
                        $this->msg = "Tous les champs doivent être remplis.";
                    }
                }
            }
                include(__DIR__ . '/../view/header.php');
                include(__DIR__ . "/../view/popUp.php");
                include(__DIR__ . '/../view/editProduct.php');
                include(__DIR__ . '/../view/footer.php');


        }
    }
}
?>