<?php
/**
 *  Howsy Project: file index.php
 * All requests are sent in here and processed by BasketContoller
 */

$add_slash = true;
require $_SERVER['DOCUMENT_ROOT'] . "/inc/config.php";

global $conn;
$basket = new BasketController();

if(isset($_GET["empty_cart"])){
    echo $basket->emptyBasket();
} else if(isset($_GET["add_prod"])){
    echo $basket->addProductToBasket($_GET["add_prod"]);
} else {
    echo $basket->showBasket(USER_ID);
}



?>
