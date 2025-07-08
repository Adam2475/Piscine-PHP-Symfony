<?php

$myfile = fopen("ex01.txt", "r") or die("unable to open file!");

$content = fread($myfile, filesize("ex01.txt"));

$array = explode(",", $content, PHP_INT_MAX);

$i = 0;

while($i < count($array))
{
    echo($array[$i]);
    echo("\n");
    $i++;
}

fclose($myfile);

?>