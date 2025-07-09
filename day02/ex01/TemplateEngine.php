<?php

class TemplateEngine
{
    public function createFile($filename, $templateName, $parameters)
    {
        $template = file_get_contents($templateName);

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