<?php

class MyProfilController
{
    public $model;

    public $modelOrder;
    public $msg;
    public $title;
    public $param;
    public $altParam;
    public $displayValue;
    public $profil;

    public $profilsAdmin;

    public $profilsUsers;
    public $profilsEmployee;
    public $roles;
    public $orders;

    public $servicesHtml;


    public function __construct()
    {
        $this->model = new ModelUser();
        $this->modelOrder = new ModelOrders();
        $this->msg = null;
        $this->title = "Mon Profil";
        $this->param = "index.php?page=myProfil";
        $this->altParam = "retour";
        $this->displayValue = "retour";
        $this->servicesHtml = new Html();

    }

    public function manage()
    {
        if (isset($_SESSION["user"]['id'])) {
            $this->profil = $this->model->getOneUser($_SESSION['user']['email']);
        }

        if (isset($_SESSION["user"]['id']) && $_SESSION["user"]["role"] == "administrateur"){
            if (!empty($_POST)){
                if (!empty($_POST["Role"]) && !empty($_POST["Email"])){
                    $roleId = $this->model->getRoleId($_POST["Role"]);
                    $this->model->updateUser($roleId["role_id"], $_POST["Email"]);
                }
            }

            $this->roles = $this->model->getAllRoles();
            $this->profilsAdmin = $this->servicesHtml->CreateTableHtml($this->model->getAllUserAdmin(), $this->roles);
            $this->profilsUsers = $this->servicesHtml->CreateTableHtml($this->model->getAllUsers(), $this->roles);
            $this->profilsEmployee = $this->servicesHtml->CreateTableHtml($this->model->getAllUsersEmployee(), $this->roles);
            $this->orders = $this->servicesHtml->CreateTableHtml($this->modelOrder->getAllOrders(), "", true);
        }

        include(__DIR__ . "/../view/header.php");
        include(__DIR__ . "/../view/popUp.php");
        include(__DIR__ . "/../view/myProfil.php");
        include(__DIR__ . "/../view/footer.php");
    }
}
