<?php

include "TemplateEngine.php";

$elem = new Elem("html");
$body = new Elem("body");

$body->pushElement(new Elem("p", "lorem ipsum", ['class' => 'text-muted']));
$elem->pushElement($body);

echo $elem->getHTML();

try {
    $elem = new Elem('undefined');
}
catch(Exception $e)
{
    echo ($e);
    return 1;
}
finally
{
    print("exited after throwing exception!\n");
}

?>