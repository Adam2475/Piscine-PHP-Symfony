<?php

class Elem
{
    public $element;
    public string $content;
    public array $result = array();
    public $all = array("meta", "img", "hr", "br", "html", "head"
                        , "body", "title", "h1", "h2", "h3", "h4"
                        , "h5", "h6", "p", "span", "div");
    public array $prev_contents = array();

    function __construct($element, string $content = "null")
    {
        $this->content = $content;

        // echo ($content . "\n");

        $this->element = $element;

        $this->prev_contents[] = $this->content;

        if ($this->tag_found($this->element))
            $this->result[] = array("<$this->element>", "</$this->element>");
        else 
            return print "not supported tag!\n";
    }

    public function pushElement(Elem $elem)
    {
        $i = 0;
        //echo ($elem->content . "\n");
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

        // print_r($this->prev_contents);

        // $x = count($this->prev_contents) - 1;

        // echo ($this->content . "\n");
        $tmp = $this->prev_contents[$i];
        if ($tmp != "null")
        {
            // echo ($i. "\n");
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