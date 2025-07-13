<?php

include "MyException.php";

class Elem
{
    public $element;
    public string $content;
    public array $result = array();
    public array $attributes;

    // reformatting elem to a tree structure
    // where an Elem can have multiple childs
    public array $children = [];

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
        $this->children[] = $elem;
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

    public function recursive_helper($file, $i = 0)
    {
        $indentation = str_repeat("\t", $i);

        // writing the front tag
        fwrite($file, $indentation . $this->result[0][0] . "\n");


        foreach ($this->children as $child)
        {
            // i++ incremented at end of function
            $child->recursive_helper($file, $i + 1);
        }

        // write the tag content
        if ($this->content != "null")
        {
            fwrite($file, $indentation . "\t" . "$this->content\n");
        }

        // writing the closing tag
        fwrite($file, $indentation . $this->result[0][1] . "\n");
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

    public function validPage(): bool
    {
        // Check root node is html
        if ($this->element !== "html") return false;

        // Check it has exactly two children: head and body in order
        if (count($this->children) !== 2) return false;
        if ($this->children[0]->element !== "head" || $this->children[1]->element !== "body")
            return false;

        // Check <head> rules
        if (!$this->checkHead($this->children[0]))
            return false;

        // Recursively check all elements
        return $this->recursiveValidation($this);
    }

    private function checkHead(Elem $head): bool
    {
        $titleCount = 0;
        $metaCharsetCount = 0;

        foreach ($head->children as $child) {
            if ($child->element === "title")
                $titleCount++;
            if ($child->element === "meta" && isset($child->attributes["charset"]))
                $metaCharsetCount++;
        }

        return $titleCount === 1 && $metaCharsetCount === 1;
    }

    private function recursiveValidation(Elem $node): bool
    {
        // Rule: <p> can't contain any child tags
        if ($node->element === "p" && count($node->children) > 0)
            return false;

        // Rule: <table> can only contain <tr>
        if ($node->element === "table") {
            foreach ($node->children as $child) {
                if ($child->element !== "tr")
                    return false;
            }
        }

        // Rule: <tr> can only contain <th> or <td>
        if ($node->element === "tr") {
            foreach ($node->children as $child) {
                if ($child->element !== "th" && $child->element !== "td")
                    return false;
            }
        }

        // Rule: <ul> and <ol> can only contain <li>
        if ($node->element === "ul" || $node->element === "ol") {
            foreach ($node->children as $child) {
                if ($child->element !== "li")
                    return false;
            }
        }

        // Check recursively
        foreach ($node->children as $child) {
            if (!$this->recursiveValidation($child))
                return false;
        }

        return true;
    }
}

?>