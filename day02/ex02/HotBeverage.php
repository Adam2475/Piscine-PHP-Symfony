<?php

class HotBeverage
{
    protected $nom;
    protected $prix;
    protected $resistance;

    public function getName() {
        return $this->nom;
    }

    public function getPrice() {
        return $this->prix;
    }

    public function getResistence() {
        return $this->resistance;
    }
}

?>