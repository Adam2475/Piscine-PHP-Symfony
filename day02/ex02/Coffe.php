<?php

include_once "HotBeverage.php";

class Coffe extends HotBeverage
{
    private $description;
    private $commentaire;

    function __construct($name, $price, $resistence, $descrtiption, $comment)
    {
        $this->nom = $name;
        $this->prix = $price;
        $this->resistance = $resistence;
        $this->description = $description;
        $this->commentaire = $comment;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getComment() {
        return $this->commentaire;
    }
}

?>