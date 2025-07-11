<?php

include "HotBeverage.php";

class TemplateEngine
{
    public function createFile(HotBeverage $text)
    {
        $var = $text.getName();
        echo($var . "\n");
    }
}

?>