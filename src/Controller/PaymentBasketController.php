<?php
class PaymentBasketController
{
    public $model;
    public $title;
    public $products;
    public $total2pay;
    public $msg;
    public $param;
    public $altParam;
    public $displayValue;

    public function __construct()
    {
        $this->model = new Model();
        $this->title = "Payment";
        $this->products = $this->model->getProducts();
        $this->total2pay = 0;
    }

    public function manage()
    {
        if (isset($_POST["total2Pay"])) {
            $this->total2pay = +$_POST["total2Pay"];
        };

        if (isset($_SESSION["user"])) {
            if (isset($_GET["valid"])) {
                $this->model->newOrder($_SESSION["user"]["id"], $_SESSION["user"]["basket"]);
                unset($_SESSION["user"]["basket"]);
                header("Location: index.php?page=home&thanks=true");
            };
        } else {
            header("Location: index.php?page=signIn");
        };

        if (isset($_GET["pay"]) && $_GET["pay"] === "true") {
            $this->msg = "Le paiement a été accepté par votre banque.<br><br>Votre commande est validée.<br><br>Vous pouvez fermer cette fenêtre.";
            $this->param = "index.php?page=paymentBasket&valid=true";
            $this->altParam = "Fermer";
            $this->displayValue = "Fermer";
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/popUp.php');
        include(__DIR__ . '/../view/paymentBasket.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
