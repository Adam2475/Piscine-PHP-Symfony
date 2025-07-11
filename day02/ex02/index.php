<?php

include "TemplateEngine.php";
include "Tea.php";
include "Coffe.php";

$tea = new Tea("the", "12", "wtf", "commie", "gesu gesuita gesuoso");
$coffe = new Tea("buongiornissimo caffe", "90", "cristo", "nazi", "la madonna");

$var = new TemplateEngine();

$var->createFile($tea);
$var->createFile($coffe);

?>