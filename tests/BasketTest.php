<?php
use PHPUnit\Framework\TestCase;

require $_SERVER['DOCUMENT_ROOT'] . "inc/config.php";

final class BasketTest extends TestCase
{
    public $controllerBaskset;
    public function setUp()
    {
        // set the basket controller
        $this->controllerBaskset = new BasketController();

        // empty basket at the beginning of the process
        $this->controllerBaskset->emptyBasket();
        parent::setUp();
    }

    // show empty basket
    public function test_controller_show_basket()
    {
        $basketController = $this->controllerBaskset->showBasket(USER_ID);
        $this->assertEquals(json_encode([
            "message" => "success",
            "data" => [
                "0" => "Basket empty.",
                "user_offer" => [
                    "name" => "12 months contract",
                    "discount" => "10%"
                ]
            ]
        ]), $basketController);
    }

    public function test_empty_basket()
    {
        $basketController = $this->controllerBaskset->emptyBasket();

        $this->assertEquals(json_encode([
            "success" => "Basket empty"
        ]), $basketController);
    }

    public function test_add_a_non_existing_product()
    {
        $basketController = $this->controllerBaskset->addProductToBasket("P00100");

        $this->assertEquals(json_encode([
            "success" => false,
            "message" => "Product not existing!"
        ]), $basketController);
    }

    public function test_add_a_product()
    {
        $basketController = $this->controllerBaskset->addProductToBasket("P001");
        $this->assertEquals(json_encode([
            "success" => true,
            "message" => "Product added!",
            "product" => [
                "product_code" => "P001",
                "name" => "Photography",
                "price" => "200"
            ]
        ]), $basketController);
    }
}
