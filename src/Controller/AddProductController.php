<?php
class AddProductController
{
    public $model;
    public $msg;
    public $title;
    public $categories;
    public $param;
    public $altParam;
    public $displayValue;


    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Ajouter un Produit";
        $this->categories = $this->model->getCategories();
        $this->param = "index.php?page=addProduct";
        $this->altParam = "retour";
        $this->displayValue = "Retour";
    }

    public function manage()
    {
                        if (!isset($_SESSION['user'])) {
                header('Location: index.php?page=signIn');
                exit();
            }
     
            if (!empty($_POST)) {

                $name = isset($_POST['name']) ? $_POST['name'] : null;
                $category = isset($_POST['category']) ? $_POST['category'] : null;
                $picture = isset($_FILES['picture']['name']) ? $_FILES['picture']['name'] : null;
                $description = isset($_POST['description']) ? $_POST['description'] : null;
                $origin = isset($_POST['origin']) ? $_POST['origin'] : null;
                $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
                $price = isset($_POST['price']) ? $_POST['price'] : null;

                if (empty($name) || empty($category) || empty($picture) || empty($description) || empty($origin) || empty($quantity) || empty($price)) {
                    $this->msg = "Tous les champs doivent être remplis.";
                } else {
                    $targetDir = "src/public/img/uploads/";
                    $targetFile = $targetDir . basename($picture);


                    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                        $result = $this->model->addProduct($name, $category, $targetFile, $description, $origin, $quantity, $price);

                        if ($result) {
                            $this->msg = "Produit ajouté avec succès";
                            header('Location: index.php?page=listProducts');
                            exit();
                        } else {
                            $this->msg = "Ajout de produit échoué";
                        }
                    } else {
                        $this->msg = "Échec du téléchargement de l'image.";
                    }
                }
            }

            include(__DIR__ . "/../view/header.php");
            include(__DIR__ . "/../view/popUp.php");
            include(__DIR__ . "/../view/addProduct.php");
            include(__DIR__ . "/../view/footer.php");
        }

}