<?php

session_start();

if (isset($_GET['logout'])){
    $_SESSION = [];
    session_destroy();
}

require('src/Controller/HomeController.php');
require('src/Controller/SignUpController.php');
require('src/Controller/SignInController.php');

$page = filter_input(INPUT_GET, "page");

$route = [
    "signUp" => SignUpController::class,
    "signIn" => SignInController::class
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
