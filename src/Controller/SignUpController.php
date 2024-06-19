<?php

class SignUpController
{
    public $title;

    public $model;

    public $msg;

    public function __construct()
    {
        $this->title = "S'inscrire";
        $this->model = new ModelUser();
    }

    public function manage()
    {

        if (isset($_POST['email']) && isset($_POST['firstname']) && isset($_POST['lastname'])
            && isset($_POST['password']) && isset($_POST['address']) && isset($_POST['zipcode'])
            && isset($_POST['city']) && isset($_POST['phone']) && isset($_POST['birthday'])){

            if (empty(trim($_POST['email'])) || empty(trim($_POST['firstname'])) ||
                empty(trim($_POST['lastname'])) || empty(trim($_POST['password'])) || empty(trim($_POST['address']))
                || empty(trim($_POST['zipcode'])) || empty(trim($_POST['city'])) || empty(trim($_POST['phone']))
                || empty(trim($_POST['birthday']))){

                $this->msg = "Merci de renseigner les champs suivant :";

                foreach ($_POST as $key => $value) {
                    if (empty(trim($value))) {
                        $this->msg .= " $key.";
                    }
                }

            }else{

                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $idUser = $this->model->addNewUser($_POST['firstname'], $_POST['lastname'],$_POST['email'], $password,
                                                   $_POST['address'], $_POST['zipcode'],$_POST['city'],$_POST["phone"],
                                                   $_POST["birthday"]);


                if ($idUser){

                    $_SESSION['user'] = [
                        'firstname'=> $_POST["firstname"],
                        'email' => $_POST["email"],
                        'id'    => $idUser,
                        'role'  => null
                    ];

                    header('Location: index.php');
                }
            }

        }

        include(__DIR__ . '/../view/header.php');
        include(__DIR__ . '/../view/signUp.php');
    }
}