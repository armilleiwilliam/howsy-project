<?php

// In order to run Basket controller in phpUnit test witouth using a framework
// I need to flush the buffers using ob_start below
ob_start();

/**
 * This is the Basket controller: every action like addition, removal or total calculation is found in this controller
 */
class BasketController
{

    /**
     * @param int|NULL $userId
     * @return String
     */
    public function showBasket(int $userId = NULL): String
    {
        $basket = ["Basket empty."];
        $myDiscount = 0;
        $totals = 0;
        if(isset($_COOKIE["shopping_cart"])){
            $basket = $this->stripBasket($_COOKIE["shopping_cart"]);
        }

        //get User Offer
        if($userId !== null){
            $offer = (new Offer())->getMyOffer($userId);
            if($offer){
                $basket["user_offer"]["name"] = $offer->getMyOfferName();
                $basket["user_offer"]["discount"] = $offer->getMyDiscount() . "%";
                $myDiscount = $offer->getMyDiscount();
            } else {
                $basket["user_offer"]["name"] = "No offer associated to this user";
            }
        }

        // calculate totals
        if(!empty($basket["products"])){
            foreach ($basket["products"] AS $bas){
                $totals += $bas["price"];
            }
            $basket["total_price"] = $totals;

            if($myDiscount) {
                $basket["total_price_discounted"] = $totals - ($totals / 100 * 10);
            }
        }

        return json_encode(["message" =>  "success", "data" => $basket]);
    }

    /**
     * @param int $product
     * @return String
     */
    public function addProductToBasket(String $product): String
    {
        $success = ["success" => false, "message" => "Wrong product code format provided!"];

        // first sanitize string entered, in case of Hacking attacks
        if($product = filter_var($product ,FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH)){
            $addProduct = (new Product())->getProduct($product);
            $cart_data = [];
            $success = ["success" => false, "message" => "Product not existing!"];

            // check first if product exists
            if($addProduct->query->rowCount() > 0) {
                $success = ["success" => false, "message" => "Product already added!"];

                if (!$this->checkIfProdAlreadyExistsInBasket($addProduct->getProductCode())) {
                    if (isset($_COOKIE["shopping_cart"])) {
                        $cart_data = $this->stripBasket($_COOKIE["shopping_cart"]);
                    }

                    $newProduct = ["product_code" => $addProduct->getProductCode(), "name" => $addProduct->getName(), "price" => $addProduct->getPrice()];
                    $cart_data["products"][] = $newProduct;
                    $cart_data = json_encode($cart_data);
                    $success = ["success" => true, "message" => "Product added!", "product" => $newProduct];
                    setcookie('shopping_cart', $cart_data, time() + 3650);
                }
            }
        }
        return json_encode($success);
    }

    /**
     * @param $product_code
     * @return bool
     */
    public function checkIfProdAlreadyExistsInBasket($product_code = NULL): bool
    {
        $addProd = false;
        if(isset($_COOKIE["shopping_cart"])){
            $cart_data = $this->stripBasket($_COOKIE["shopping_cart"]);

            // loop cart
            foreach ($cart_data["products"] as $cart){
                if($product_code == $cart["product_code"]){
                    $addProd = true;
                }
            }
        }
        return $addProd;
    }

    /**
     * remove slashes and then convert from json to array
     * @param $shopping_cart
     * @return mixed
     */
    private function stripBasket($shopping_cart)
    {
        $cookie_data = stripcslashes($shopping_cart);
        return json_decode($cookie_data, true);
    }

    /**
     * @return String
     */
    public function emptyBasket(): String
    {
        setcookie('shopping_cart', '', time() - 100000);
        return json_encode(["success" => "Basket empty"]);
    }
}