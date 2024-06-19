<?php
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
        $this->categories = $this->model->getCategories();
    }

    public function manage()
    {
            session_start();

            if (!isset($_SESSION['user'])) {
                header('Location: index.php?page=signIn');
                exit();
            }

            if (isset($_POST['submit'])) {
                $name = isset($_POST['name']) ? $_POST['name'] : null;
                $category = isset($_POST['category']) ? $_POST['category'] : null;
                $picture = isset($_FILES['picture']['name']) ? $_FILES['picture']['name'] : null;
                $description = isset($_POST['description']) ? $_POST['description'] : null;
                $origin = isset($_POST['origin']) ? $_POST['origin'] : null;
                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
                $price = isset($_POST['price']) ? $_POST['price'] : null;
                $date = isset($_POST['date']) ? $_POST['date'] : null;

                if (empty($name) || empty($category) || empty($picture) || empty($description) || empty($origin) || empty($quantity) || empty($price) || empty($date)) {
                    $this->msgError = "Tous les champs doivent être remplis.";
                } else {
                    $targetDir = "uploads/";
                    $targetFile = $targetDir . basename($picture);

                    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                        $result = $this->model->addProduct($name, $category, $targetFile, $description, $origin, $quantity, $price, $date);

                        if ($result) {
                            $this->msgSuccess = "Produit ajouté avec succès";
                            header('Location: index.php?page=listProducts');
                            exit();
                        } else {
                            $this->msgError = "Ajout de produit échoué";
                        }
                    } else {
                        $this->msgError = "Échec du téléchargement de l'image.";
                    }
                }
            }

            include(__DIR__ . "/../view/header.php");
            include(__DIR__ . "/../view/popUp.php");
            include(__DIR__ . "/../view/addProduct.php");
            include(__DIR__ . "/../view/footer.php");
        }

}