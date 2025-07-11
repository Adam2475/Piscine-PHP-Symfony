<?php

include "HotBeverage.php";

class TemplateEngine
{
    public function createFile(HotBeverage $text)
    {
        $name = $text->getName();
        $file = fopen("$name.html", "w");

        $reflector = new ReflectionClass($text);

        $properties = $reflector->getProperties();

        fwrite($file, "<!DOCTYPE html>\n<html>\n\t<head>\n\t\t<title>{nom}</title>\n\t</head>\n");
        fwrite($file, "\t<body>\n\t\t<h1>{nom}</h1>\n\t\t<p>\n\t\t\tPrix: {prix} &euro;<br />\n");
        fwrite($file, "\t\t\tResistance au sommeil: {resistance}/5\n\t\t</p>\n\t\t<p>Description: {description}</p>\n");
        fwrite($file, "\t\t<p>Commentaire: {commentaire}</p>\n\t</body>\n</html>\n");
        fclose($file);

        $template = file_get_contents("$name.html");

        foreach ($properties as $property)
        {
            $props = explode("$", "$property")[1];
            $array = explode("=", "$props");
            $key = trim($array[0]);
            $value = $property->getValue($text);
            $template = str_replace("$key", "$value", $template);
        }

        file_put_contents("$name.html", $template);
    }
}

?>