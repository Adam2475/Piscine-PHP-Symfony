<?php

class TemplateEngine
{
    public function createFile($filename, $templateName, $parameters)
    {
        $file = fopen("$filename", "w");        
        fwrite($file, 
"<!DOCTYPE html>
<html>
    <head>
        <title>{nom}</title>
    </head>
    <body>
        <h1>{nom}</h1>
        <p>
            Auteur: <b>{auteur}</b><br />
            Description: {description}<br />
            Prix: <b>{prix} &euro;</b>
        </p>
    </body>
</html>
");

        $template = file_get_contents("$filename");

        if (!($template))
            exit("template name not found!\n");
        
        $i = 0;
        while ($i < count($parameters))
        {
            $ptr = $parameters[$i];
            $value = current($ptr);
            $key = key($ptr);
            $template = str_replace('{' . $ptr[1] . '}', "$value", $template);
            $i++;
        }
        file_put_contents($filename, $template);
    }
}

?>