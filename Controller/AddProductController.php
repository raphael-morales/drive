<?php

namespace Controller;

use Model\Model;

class AddProductController
{
    public $model;
    public $msgSuccess;
    public $msgError;
    public $title;
    public $categories;

    public function __construct()
    {
        $this->model = new Model();
        $this->msgSuccess = null;
        $this->msgError = null;
        $this->title = "Ajouter un Produit";
        $this->categories = $this->model->getCategories(); // Assuming getCategories method is implemented in the model to fetch categories
    }

    public function manage()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=signIn');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $category = $_POST['category'];
            $picture = $_FILES['picture']['name'];
            $description = $_POST['description'];
            $origin = $_POST['origin'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $date = $_POST['date'];

            if (empty($name) || empty($category) || empty($picture) || empty($description) || empty($origin) || empty($quantity) || empty($price) || empty($date)) {
                $this->msgError = "Tous les champs doivent être remplis.";
            } else {
                $targetDir = "uploads/";
                $targetFile = $targetDir . basename($picture);
                move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile);

                $result = $this->model->addProduct($name, $category, $targetFile, $description, $origin, $quantity, $price, $date);
                if ($result) {
                    $this->msgSuccess = "Produit ajouté avec succès";
                    header('Location: index.php?page=listProducts');
                    exit();
                } else {
                    $this->msgError = "Ajout de produit échoué";
                }
            }
        }

        include(__DIR__ . "/../view/header.php");
        include(__DIR__ . "/../view/popUp.php");
        include(__DIR__ . "/../view/addProduct.php");
        include(__DIR__ . "/../view/footer.php");
    }
}
