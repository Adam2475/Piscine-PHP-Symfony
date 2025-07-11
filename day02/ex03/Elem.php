<?php

class Elem
{
    public $element;
    public array $content = array();
    public $all = array("meta", "img", "hr", "br", "html", "head"
                        , "body", "title", "h1", "h2", "h3", "h4"
                        , "h5", "h6", "p", "span", "div");

    function __construct($element, $content = 0)
    {
        if ($content != 0)
            $this->content = $content;

        $this->element = $element;

        if ($this->tag_found($this->element))
            $this->content[] = array("<$this->element>", "</$this->element>");
        else 
            return print "not supported tag!\n";
    }

    public function pushElement(Elem $elem)
    {
        $i = 0;
        foreach ($elem->content as $tag)
        {
            $this->content[] = array($elem->content[$i][0], $elem->content[$i][1]);
            $i++;
        }
    }

    public function getHTML()
    {
        $i = 0;
        $file = fopen("template.html", "w");
        $this->recursive_helper($file, $i);
        fclose($file);
    }

    public function recursive_helper($file, $i)
    {
        if ($i >= count($this->content))
            return 1;
        $front = $this->content[$i][0];
        $back = $this->content[$i][1];
        $j = $i;
        while ($j-- > 0)
            fwrite($file, "\t");
        fwrite($file, "$front\n");
        $this->recursive_helper($file, ++$i);
        $j = 0;
        while ($j++ < $i - 1)
            fwrite($file, "\t");
        fwrite($file, "$back\n");
        return 0;
    }

    public function tag_found(string $element)
    {
        foreach ($this->all as $tag)
        {
            if ($tag == $element)
            {
                return 1;
            }
        }
        return 0;
    }
}


?>