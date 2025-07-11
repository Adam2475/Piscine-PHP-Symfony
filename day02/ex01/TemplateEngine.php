<?php

include "Text.php";

class TemplateEngine
{
    public function createFile($fileName, Text $text)
    {
        $text->addStrings(array("maiale", "bovino", "gatto"));
        $text->renderStrings($fileName);
    }
}

?>