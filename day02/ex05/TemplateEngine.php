<?php

include "Elem.php";

class TemplateEngine
{
    public function createFile(Elem $param)
    {
        $param->pushElement();
    }
}

?>