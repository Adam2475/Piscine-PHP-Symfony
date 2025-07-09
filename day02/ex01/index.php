<?php
include "TemplateEngine.php";

$dio = array(array("cane", "auteur"), array("gatto", "description"), array("piccione", "prix"));

$a = new TemplateEngine();

$a->createFile("test.html", "book_description.html", $dio);

?>