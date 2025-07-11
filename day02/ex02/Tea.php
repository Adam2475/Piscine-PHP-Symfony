<?php

include_once "HotBeverage.php";

class Tea extends HotBeverage
{
    private $description;
    private $comment;

    function __construct($name, $price, $resistence)
    {
        $this->name = $name;
        $this->price = $price;
        $this->resistence = $resistence;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getComment() {
        return $this->comment;
    }
}

?>