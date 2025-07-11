<?php

include_once "HotBeverage.php";

class Tea extends HotBeverage
{
    private $description;
    private $commentaire;

    function __construct($nom, $prix, $resistance, $description, $comentaire)
    {
        $this->nom = $nom;
        $this->prix = $prix;
        $this->resistance = $resistance;
        $this->description = $description;
        $this->commentaire = $comentaire;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getComment() {
        return $this->comentaire;
    }
}

?>