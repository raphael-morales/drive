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

    // private function validatePayment($cardNumber, $cardExpiry, $cardCvc)
    // {
    //     $errors = [];
    //     if (empty($cardNumber) || !preg_match('/^\d{16}$/', $cardNumber)) {
    //         $errors[] = "Numéro de carte invalide.";
    //     }
    //     if (empty($cardExpiry) || !preg_match('/^\d{2}\/\d{2}$/', $cardExpiry)) {
    //         $errors[] = "Date d'expiration invalide.";
    //     }
    //     if (empty($cardCvc) || !preg_match('/^\d{3}$/', $cardCvc)) {
    //         $errors[] = "CVC invalide.";
    //     }

    //     return $errors;
    // }

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
            $this->param = "index.php?page=home&valid=true";
            $this->altParam = "Fermer";
            $this->displayValue = "Fermer";
        }

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $cardNumber = $_POST['card_number'];
        //     $cardExpiry = $_POST['card_expiry'];
        //     $cardCvc = $_POST['card_cvc'];

        // $errors = $this->validatePayment($cardNumber, $cardExpiry, $cardCvc);


        // if (empty($errors)) {
        //     $paymentSuccess = true;

        //     if ($paymentSuccess) {
        //         $this->model->clearCart($_SESSION['user']['basket']);

        //         $this->title = "Paiement Réussi";
        //         include(__DIR__ . '/../view/header.php');
        //         echo "<p>Paiement réussi. Merci pour votre commande.</p>";
        //         include(__DIR__ . '/../view/footer.php');
        //     } else {
        //         $this->title = "Échec du paiement";
        //         include(__DIR__ . '/../view/header.php');
        //         echo "<p>Échec du paiement. Veuillez réessayer.</p>";
        //         include(__DIR__ . '/../view/footer.php');
        //     }
        // } else {
        //     $this->title = "Erreurs de paiement";
        //     include(__DIR__ . '/../view/header.php');
        //     foreach ($errors as $error) {
        //         echo "<p>$error</p>";
        //     }
        //     include(__DIR__ . '/../view/paymentBasket.php');
        //     include(__DIR__ . '/../view/footer.php');
        // }
        // }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/popUp.php');
        include(__DIR__ . '/../view/paymentBasket.php');
        include(__DIR__ . '/../view/footer.php');
    }
}
