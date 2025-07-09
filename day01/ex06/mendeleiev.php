<?php

if (!($data = fopen("ex06.txt", "r")))
{
     exit("failed to open the file!\n");
}

$result = array();
$i = 0;

// fill an array for the data
while (($line = fgets($data)) !== false)
{
    $result[$i] = $line;
    $i++;
}
reset($result);

////////////////////
// parsing
$i = 0;
$j = 1;
$x = 0;
// echo(current($result));
// echo(key($result));
$container = array();
$tmp = array();
$holder = array();

while (key($result) !== null)
{
    $tmp = explode("=", current($result), 2);
    $container[$i][0] = $tmp[0];
    $holder = explode(",", $tmp[1]);
    while (key($holder) !== null)
    {
        $container[$i][$j] = $holder[$x];
        $x++;
        $j++;
        next($holder);
    }
    $j = 1;
    $x = 0;
    next($result);
    $i++;
}
fclose($data);

// print_r($result);

////////////////////
// create new html
$filename = 'output.html';
if (!($page = fopen("$filename", "w")))
{
    exit("unable to create html file!\n");
}

// writing head
// $content = "<!DOCTYPE html>\n<html>\n<head>\n\t<meta charset='UTF-8'>\n\t<title>Mendeleev Table</title>\n</head>\n<body>\n";
$content = "<!DOCTYPE html>\n<html>\n<head>\n\t<meta charset='UTF-8'>\n\t<title>Mendeleev Table</title>\n\t<style>\n\t\ttable { border-collapse: collapse; }\n\t\ttd { border: 1px solid black; width: 100px; height: 60px; vertical-align: top; padding: 5px; }\n\t</style>\n</head>\n<body>\n";
fwrite($page, $content);

// writing body
$content = "<h1>Mendeleev Periodic Table</h1>\n";
fwrite($page, $content);

// create the grid, 7 periods, 18 groups
$grid = array_fill(0,7, array_fill(0, 18, null));

$i = 0;
$j = 0;
$s = 0;
// fill the grid
while ($i < count($result))
{
    $element = $container[$i];

    $name = trim($element[0]);
    $position = intval(explode(":", $element[1])[1]);
    $number = intval(explode(":", $element[2])[1]);
    $symbol = trim(explode(":", $element[3])[1]);
    $molar = trim(explode(":", $element[4])[1]);
    $electron = trim(explode(":", $element[5])[1]);

    // Period is estimated by electron shell layers
    $period = substr_count($electron, ' ') + 1;
    // echo("$period");

    $grid[$period - 1][$position] = [
        'name' => $name,
        'symbol' => $symbol,
        'number' => $number,
        'molar' => $molar,
    ];

    $i++;
}

// render the grid
$content = "\t<table>\n";
fwrite($page, $content);

$i = 0;
while ($i < count($grid))
{
    $j = 0;
    fwrite($page, "<tr>\n");
    while ($j < count($grid[$i]))
    {
        if ($grid[$i][$j] === null)
        {
            fwrite($page, "<td></td>\n");
        }
        else
        {
            $cellHTML = "<div class='symbol'>{$grid[$i][$j]['symbol']}</div>";
            $cellHTML .= "<div class='element'>{$grid[$i][$j]['name']}</div>";
            $cellHTML .= "<div>No. {$grid[$i][$j]['number']}</div>";
            $cellHTML .= "<div>{$grid[$i][$j]['molar']} g/mol</div>";
            fwrite($page, "<td>$cellHTML</td>\n");
        }
        $j++;
    }
    fwrite($page, "</tr>\n");
    $i++;
}

$content = "\t</table>\n";
fwrite($page, $content);
// writing the end of the page
$content = "</body>\n</html>\n";
fwrite($page, $content);

// print_r($grid);

fclose($page);

?>

