<?php

include "TemplateEngine.php";

// $elem = new Elem("html");
// $body = new Elem("body");
// $head = new Elem("head");

// $body->pushElement(new Elem("p", "lorem ipsum", ['class' => 'text-muted']));
// $head->pushElement(new Elem("meta"));
// $elem->pushElement($head);
// $elem->pushElement($body);

// echo $elem->getHTML();
//echo $elem->validPage() ? "✅ Valid Page\n" : "❌ Invalid Page\n";

$html = new Elem("html");

$head = new Elem("head");
$meta = new Elem("meta", "null", ["charset" => "UTF-8"]);
$title = new Elem("title", "My Page");
$head->pushElement($meta);
$head->pushElement($title);

$body = new Elem("body");
$p = new Elem("p", "Just text.");
$table = new Elem("table");
$tr = new Elem("tr");
$td = new Elem("td", "cell");
$tr->pushElement($td);
$table->pushElement($tr);
$list = new Elem("ul");
$li = new Elem("li", "Item 1");
$list->pushElement($li);

$body->pushElement($p);
$body->pushElement($table);
$body->pushElement($list);

$html->pushElement($head);
$html->pushElement($body);

echo $html->validPage() ? "✅ Valid Page\n" : "❌ Invalid Page\n";

?>