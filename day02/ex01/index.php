<?php
include "TemplateEngine.php";

$array = array("cavallo", "pecora", "cane");

$text = new Text($array);

$obj = new TemplateEngine();

$obj->createFile("create.html", $text);

?>