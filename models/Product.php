<?php

class Product
{
    public $db;
    public $query;
    public $fetch;

    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function getProduct(String $id): self
    {
        $this->query = $this->db->prepare("SELECT * FROM products WHERE product_code = :id");
        $this->query->execute(array("id" => $id));
        $this->fetch = $this->query->fetch();
        return $this;
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->fetch["product_code"];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->fetch["name"];
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->fetch["price"];
    }
}