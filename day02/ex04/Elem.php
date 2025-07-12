<?php

include "MyException.php";

class Elem
{
    public $element;
    public string $content;
    public array $result = array();
    public array $attributes;
    public string $attribute_str = "";
    public $all = array("meta", "img", "hr", "br", "html", "head"
                        , "body", "title", "h1", "h2", "h3", "h4"
                        , "h5", "h6", "p", "span", "div", "table"
                        , "tr", "th", "td", "ul", "ol", "li");
    public array $prev_contents = array();

    function __construct($element, string $content = "null", array $attributes = [])
    {
        $this->content = $content;

        $this->element = $element;

        $this->attributes = $attributes;

        if ($attributes)
        {
            $this->attribute_to_string();
        }

        $this->prev_contents[] = $this->content;

        if ($this->tag_found($this->element))
        {
            if ($attributes)
                $this->result[] = array("<$this->element" . " $this->attribute_str>", "</$this->element>");
            else
                $this->result[] = array("<$this->element>", "</$this->element>");
        }
        else
        {
            throw new InvalidTagException("$element tag not supported!");
            return 1;
        }
    }

    public function pushElement(Elem $elem)
    {
        $i = 0;
        if ($elem->content != null)
        {
            foreach($elem->prev_contents as $contents)
            {
                $this->prev_contents[] = $contents;
            }
        }
        foreach ($elem->result as $tag)
        {
            $this->result[] = array($elem->result[$i][0], $elem->result[$i][1]);
            $i++;
        }
    }

    public function attribute_to_string()
    {
        $tmp;
        foreach ($this->attributes as $attribute)
        {
            $tmp = array(key($this->attributes), '=', '"' , current($this->attributes) ,'"');
            $this->attribute_str = implode("", $tmp);
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
        if ($i >= count($this->result))
            return 1;
        $front = $this->result[$i][0];
        $back = $this->result[$i][1];
        $j = $i;
        while ($j-- > 0)
            fwrite($file, "\t");
        fwrite($file, "$front\n");

        $tmp = $this->prev_contents[$i];
        if ($tmp != "null")
        {
            $b = $i;
            while ($b > 0)
            {
                fwrite($file, "\t");
                $b--;
            }
            fwrite($file, "$tmp\n");
        }

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
                return 1;
        }
        return 0;
    }
}

?>