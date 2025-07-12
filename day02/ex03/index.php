<?php

include "TemplateEngine.php";


// $elem = new Elem('html');
// $body = new Elem('body');
// $body->pushElement(new Elem('p', 'Lorem ipsum'));
// $elem->pushElement($body);
// echo $elem->getHTML();

$elem = new Elem("html", "html content");
$body = new Elem("body", "body content");
// $engine = new TemplateEngine();

// print_r($elem->content);
// print_r($body->content);

$body->pushElement(new Elem("p", "lorem ipsum"));
$elem->pushElement($body);

// print_r($elem->result);

echo $elem->getHTML();

$elem = new Elem('undefined');

?>