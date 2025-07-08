<?php

$data = fopen("ex06.txt", "r");

if (!$data)
{
    die("failed to open the file!\n");
}

$result = array();
$i = 0;

// $line = fgets($data);

// echo($line);

while (($line = fgets($data)) !== false)
{
    // echo($result[$i]);
    // echo(fgets($data));
    $result[$i] = $line;
    // echo($line);
    // echo("\n");
    $i++;
}

print_r($result);

fclose($data);

?>