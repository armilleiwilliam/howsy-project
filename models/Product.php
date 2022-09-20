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
    public function getProduct(string $id): self
    {
        try {
            $this->query = $this->db->prepare("SELECT * FROM products WHERE product_code = :id");
            $this->query->execute(array("id" => $id));
            $this->fetch = $this->query->fetch();
            return $this;
        } catch (PDOException $e) {
            return "Coonnection failed: " . $e->getMessage();
        }
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