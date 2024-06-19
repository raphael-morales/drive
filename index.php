<?php

session_start();

if (isset($_GET['logout'])){
    $_SESSION = [];
    session_destroy();
}

require('src/Controller/HomeController.php');
require('src/Controller/SignUpController.php');
require('src/Controller/SignInController.php');
require('src/Controller/AddProductController.php');
require('src/Controller/ListProductsController.php');
require('src/Model/Model.php');
require('src/Model/ModelUser.php');

$page = filter_input(INPUT_GET, "page");

$route = [
    "signUp" => SignUpController::class,
    "signIn" => SignInController::class,
    "addProduct" => AddProductController::class,
    "listProducts" => ListProductsController::class,
];

$controller = null;

foreach ($route as $routeValue => $className) {

    if ($page === $routeValue) {
        $controller = new $className;
        $controller->manage();
    }
}

if (!$controller) {
    $controller = new HomeController();
    $controller->manage();
}

?>
