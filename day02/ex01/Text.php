<?php

class Text
{
    public $arr;
    //////////////////////
    // Methods
    function __construct($strings)
    {
        $this->arr = $strings;
    }
    public function addStrings(array $str)
    {
        foreach ($str as $string)
        {
            $this->arr[] = $string;
        }
    }
    public function renderStrings(string $filename)
    {
        $i = 0;
        $file = fopen("$filename", "w");
        fwrite($file, "<!DOCTYPE html>\n<html>\n<head>\n\t<title>created</title>\n</head>\n");
        fwrite($file, "<body>\n");

        // print_r($this->arr);

        while($i < count($this->arr))
        {
            $tmp = $this->arr[$i];
            fwrite($file, "\t<p> $tmp <p>\n");
            $i++;
        }

        fwrite($file, "</body>\n</html>\n");
        fclose($file);
    }
}

?>