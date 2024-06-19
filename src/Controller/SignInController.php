<?php

class SignInController
{
    public $model;
    public $msg;
    public $title;
    public $param;
    public $altParam;
    public $displayValue;

    public function __construct()
    {
        $this->model = new Model();
        $this->msg = null;
        $this->title = "Se connecter";
        $this->param = "index.php?page=signIn";
        $this->altParam = "retour";
        $this->displayValue = "Retour";
    }

    public function manage()
    {
        if (isset($_POST['email'])) {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = $this->model->getOneUser($_POST['email']);

                if ($user === false) {
                    $this->msg = 'Erreur ! Merci de reéssayer dans un moment !';
                } elseif (!$user || !password_verify($_POST['password'], $user['user_password'])) {
                    $this->msg = 'Merci de vérifier votre email et mot de passe !';
                } else {
                    $_SESSION['user'] = [
                        'firstname'=> $user["user_firstname"],
                        'email' => $user["user_email"],
                        'id'    => $user['user_id'],
                        'role'  => $user['role_name']
                    ];

                    header('Location: index.php');
                };
            } else {
                $this->msg = "<p>Merci de compléter les champs suivants:";
                foreach ($_POST as $key => $value) {
                    if (empty($value)) {
                        $this->msg .= "<br> -> $key";
                    }
                };
            }
        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/signIn.php');
    }
}