<?php
require $_SERVER['DOCUMENT_ROOT'] . "/inc/config.php";

global $conn;

$basket = new BasketController();
$user = 1;

if(isset($_GET["empty_cart"])){
    echo $basket->emptyBasket();
} else if(isset($_GET["add_prod"])){
    echo $basket->addProductToBasket($_GET["add_prod"]);
} else {
    echo $basket->showBasket($user);
}



?>
