<?php

include "TemplateEngine.php";


// $elem = new Elem('html');
// $body = new Elem('body');
// $body->pushElement(new Elem('p', 'Lorem ipsum'));
// $elem->pushElement($body);
// echo $elem->getHTML();

$elem = new Elem("html");
$body = new Elem("body");
// $engine = new TemplateEngine();

// print_r($elem->content);
// print_r($body->content);

$body->pushElement(new Elem("p"));
$elem->pushElement($body);

// print_r($elem->content);

echo $elem->getHTML();

?>