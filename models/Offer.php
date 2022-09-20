<?php

class Offer
{
    public $db;
    public $query;
    public $fetchOffer;
    public $fetchMyOffer;

    /**
     *
     */
    public function __construct()
    {
        global $conn;
        $this->db = $conn;
    }

    /**
     * @param $id
     * @return $this
     */
    public function getOffer($id): self
    {
        $this->query = $this->db->prepare("SELECT * FROM offers WHERE id = :id");
        $this->query->execute(array("id" => $id));
        $this->fetchOffer = $this->query->fetch();
        return $this->fetchOffer;
    }

    /**
     * @return string
     */
    public function getDiscount(): string
    {
        return $this->fetchOffer["discount"];
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function getMyOffer(int $user_id)
    {
        try {
            $this->query = $this->db->prepare("SELECT * FROM offers 
                            left join client_offers on offers.id = client_offers.offer_id 
                            WHERE client_offers.client_id = :user_id");
            $this->query->execute(array("user_id" => $user_id));
            $this->fetchMyOffer = $this->query->fetch();
            return $this;
        } catch (PDOException $e) {
            return "Coonnection failed: " . $e->getMessage();
        }
    }

    /**
     * @return String
     */
    public function getMyDiscount(): string
    {
        return $this->fetchMyOffer["discount"];
    }

    /**
     * @return String
     */
    public function getMyOfferName(): string
    {
        return $this->fetchMyOffer["name"];
    }
}